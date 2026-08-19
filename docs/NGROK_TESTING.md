# ngrok Testing Guide

## Overview

ngrok creates a public HTTPS URL that tunnels to your local development server. This is required for testing SSLCommerz because the gateway needs to send callbacks to a publicly accessible HTTPS URL.

## Prerequisites

1. ngrok installed ([download](https://ngrok.com/download))
2. PHP 8.4+ installed
3. SQLite database (already configured)

## Step 1: Start the Development Server

```bash
# From project root
php artisan serve --host=0.0.0.0 --port=8000
```

This starts the Laravel development server on `http://0.0.0.0:8000`.

## Step 2: Start ngrok Tunnel

Open a new terminal and run:

```bash
ngrok http 8000
```

ngrok will display something like:

```
Forwarding  https://abc123.ngrok-free.app -> http://localhost:8000
```

Copy the HTTPS URL (e.g., `https://abc123.ngrok-free.app`).

## Step 3: Update APP_URL

Set the `APP_URL` in your `.env` to the ngrok HTTPS URL:

```env
APP_URL=https://abc123.ngrok-free.app
```

Then clear the config cache:

```bash
php artisan config:clear
```

**Important**: Every time ngrok restarts, it gives a new URL. Update `APP_URL` accordingly.

## Step 4: Configure SSLCommerz

Update `.env` for sandbox testing:

```env
SSLCZ_TESTMODE=true
SSLCZ_STORE_ID=your_sandbox_store_id
SSLCZ_STORE_PASSWORD=your_sandbox_store_password
IS_LOCALHOST=true
APP_URL=https://abc123.ngrok-free.app
```

## Step 5: Verify Setup

### 5.1 Check HTTPS

Open `https://abc123.ngrok-free.app` in your browser.

- The ngrok browser warning page may appear — click "Visit Site"
- The application should load over HTTPS

### 5.2 Check Session

Navigate to a page. Ensure:
- No redirect loops
- Session is preserved
- CSRF tokens work

### 5.3 Check POST Requests

Submit a form (e.g., contact form). Ensure:
- No 419 (CSRF token mismatch) errors
- Forms submit successfully

## Step 6: Test Donation Flow

1. Go to `https://abc123.ngrok-free.app/donation`
2. Fill in the donation form
3. Select SSLCommerz as payment method
4. Submit the form
5. You should be redirected to SSLCommerz sandbox payment page
6. Complete the sandbox payment
7. SSLCommerz should redirect back to `/sslcommerz/success`
8. Verify the donation is marked as successful

## Step 7: Test IPN

IPN (Instant Payment Notification) is sent by SSLCommerz server-to-server.

1. Complete a test payment
2. Check Laravel logs: `php artisan pail`
3. Look for `SSLCommerz IPN received` log entry
4. Verify the transaction is updated

## Troubleshooting

### 419 CSRF Token Mismatch

**Cause**: Session cookies not working over HTTPS.

**Fix**:
```php
// config/session.php
'secure' => true,
'same_site' => 'lax',
```

### Redirect Loop

**Cause**: Trusted proxies not configured.

**Fix**: Ensure `TrustProxies` middleware has `$proxies = '*'` (already configured).

### SSLCommerz Callback Not Reaching Application

**Cause**: ngrok URL incorrect or not set.

**Fix**:
1. Verify `APP_URL` matches ngrok URL
2. Check SSLCommerz config URLs match the application routes
3. Run `php artisan config:clear`

### Session Expired After Payment

**Cause**: Session not persisted across redirects.

**Fix**: Ensure `SESSION_DRIVER=cookie` in `.env`.

### SSLCommerz Shows "Invalid URL"

**Cause**: Callback URLs not configured correctly.

**Fix**:
1. Check `config/sslcommerz.php` URLs are relative paths
2. Ensure `APP_URL` is set correctly
3. Verify the routes exist: `php artisan route:list | grep sslcommerz`

### Database Locked Error

**Cause**: SQLite concurrent access issue.

**Fix**: Use MySQL/PostgreSQL for production. For development, use file-based SQLite with `DB_DATABASE=/path/to/database.sqlite`.

## Environment Variables Summary

```env
APP_URL=https://abc123.ngrok-free.app
SSLCZ_TESTMODE=true
SSLCZ_STORE_ID=your_sandbox_store_id
SSLCZ_STORE_PASSWORD=your_sandbox_store_password
IS_LOCALHOST=true
PAYMENT_GATEWAY=sslcommerz
CACHE_STORE=file
SESSION_DRIVER=cookie
DB_CONNECTION=sqlite
```

## Security Notes

- **Never use ngrok for production**
- Sandbox credentials are different from production
- `IS_LOCALHOST=true` disables SSL verification (only for development)
- ngrok free tier has rate limits
- ngrok URLs expire on restart

## Checking Logs

```bash
# Real-time log viewer
php artisan pail

# Or check storage/logs/laravel.log
```

Look for:
- `SSLCommerz success callback received`
- `SSLCommerz IPN received`
- `SSLCommerz payment verified and processed`
- Any error messages

## Resetting for Clean Test

```bash
# Reset database
php artisan migrate:fresh --seed

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Restart ngrok (get new URL)
# Update APP_URL in .env
```
