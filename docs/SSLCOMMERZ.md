# SSLCommerz Payment Gateway Integration

## Overview

SSLCommerz (by SSLCOMMERZ LIMITED) is a leading payment gateway in Bangladesh. This project integrates SSLCommerz with the existing Laravel 12 application for processing donations and package purchases.

## Architecture

```
app/
├── Library/
│   └── SslCommerz/
│       ├── AbstractSslCommerz.php        # cURL-based API caller
│       ├── SslCommerzInterface.php        # Interface contract
│       └── SslCommerzNotification.php     # makePayment(), orderValidate()
├── Payments/
│   ├── Contracts/
│   │   └── PaymentGatewayInterface.php    # Generic payment gateway abstraction
│   ├── DTOs/
│   │   └── PaymentResult.php              # Payment result value object
│   ├── Exceptions/
│   │   └── PaymentException.php           # Payment-specific exception
│   └── Gateways/
│       └── SslCommerzGateway.php          # SSLCommerz implementation adapter
├── Http/
│   ├── Controllers/
│   │   ├── SslCommerzPaymentController.php  # Handles success/fail/cancel/IPN callbacks
│   │   └── Front/DonationController.php     # Donation initiation flow
│   └── Middleware/
│       ├── TrustProxies.php               # All proxies (for ngrok)
│       └── VerifyCsrfToken.php            # Excludes /sslcommerz/ipn
config/
│   └── sslcommerz.php                      # Gateway configuration
```

## Payment Flow

```
User → Donation Page → POST /donation/sslcommerz/initiate
    ↓
DonationController::initiateSslCommerz()
    ↓ Creates Donation (status: pending) + Transaction (status: pending)
    ↓ Calls SslCommerzGateway::initialize()
    ↓ Updates Donation (status: processing) + Transaction (status: processing)
    ↓
Redirects to SSLCommerz Payment Page
    ↓
Customer Completes Payment
    ↓
SSLCommerz redirects to success/fail/cancel URL (GET)
SSLCommerz sends IPN (POST)
    ↓
SslCommerzPaymentController::success/fail/cancel/ipn()
    ↓ processCallback()
    ↓   ├─ Idempotency check (skip if already successful)
    ↓   ├─ Server-side validation via SslCommerzGateway::validate()
    ↓   ├─ Amount verification
    ↓   ├─ Status update (Transaction + Donation)
    ↓   └─ Fund balance increment (if applicable)
    ↓
Redirect to success/fail page
```

## Environment Variables

Add to `.env`:

```env
# SSLCommerz Configuration
SSLCZ_TESTMODE=true          # true for sandbox, false for production
SSLCZ_STORE_ID=your_store_id
SSLCZ_STORE_PASSWORD=your_store_password
IS_LOCALHOST=true            # true for local dev (disables SSL verification)
PAYMENT_GATEWAY=sslcommerz
```

**NEVER commit production credentials.**

## Sandbox Mode

| Setting | Sandbox | Production |
|---------|---------|------------|
| `SSLCZ_TESTMODE` | `true` | `false` |
| API Domain | `sandbox.sslcommerz.com` | `securepay.sslcommerz.com` |
| Store ID | Sandbox credentials | Live credentials |
| SSL Verify | Disabled (localhost) | Enabled |

### Sandbox Test Cards

- **Success**: Use sandbox test card from SSLCommerz dashboard
- **Fail**: Use card that triggers failure
- **Cancel**: Click cancel on payment page

## Callback URLs

| Callback | URL | Method | Purpose |
|----------|-----|--------|---------|
| Success | `/sslcommerz/success` | GET/POST | Browser redirect after payment |
| Fail | `/sslcommerz/fail` | GET/POST | Browser redirect on failure |
| Cancel | `/sslcommerz/cancel` | GET/POST | Browser redirect on cancel |
| IPN | `/sslcommerz/ipn` | POST | Server-to-server notification |

All callbacks are registered in `routes/web.php`.

## Server-Side Verification

The gateway is **never** trusted on the browser redirect alone. Every callback undergoes:

1. **Idempotency check**: Skip if transaction already `successful`
2. **Server-side validation**: `SslCommerzGateway::validate()` calls SSLCommerz API
3. **Amount verification**: Compare callback amount with stored amount
4. **Currency verification**: Ensure BDT currency matches
5. **Status update**: Only update after server verification passes
6. **DB transaction**: All updates wrapped in database transaction

## CSRF Protection

The IPN endpoint (`/sslcommerz/ipn`) is excluded from CSRF verification in `app/Http/Middleware/VerifyCsrfToken.php` because SSLCommerz sends POST requests without CSRF tokens.

## Trusted Proxies (ngrok)

The `TrustProxies` middleware is configured to accept all proxies (`'*'`), which is required for ngrok HTTPS tunneling. This is safe because:
- SSL verification is handled by the gateway validation
- CSRF protection remains active
- Authentication is preserved

## Testing

### Run Tests

```bash
php artisan test --filter=SslCommerzIntegrationTest
```

### Test Coverage

| Test | Description |
|------|-------------|
| `donation_form_page_loads` | Donation page returns 200 |
| `donation_initiate_requires_validation` | Missing fields return 422 |
| `donation_initiate_rejects_minimum_amount` | Amount < 100 rejected |
| `sslcommerz_success_callback_requires_valid_data` | Missing data shows error |
| `sslcommerz_fail_callback_handles_missing_tran_id` | Graceful handling |
| `sslcommerz_cancel_callback_handles_missing_tran_id` | Graceful handling |
| `sslcommerz_ipn_requires_tran_id_and_amount` | Returns error JSON |
| `sslcommerz_ipn_handles_unknown_transaction` | No crash on unknown |
| `sslcommerz_success_callback_does_not_duplicate_payment` | Idempotent |
| `sslcommerz_ipn_does_not_duplicate_payment` | Idempotent |
| `sslcommerz_fail_callback_updates_status` | Status changed to failed |
| `sslcommerz_cancel_callback_updates_status` | Status changed to cancelled |
| `sslcommerz_routes_are_accessible` | All routes registered |

## ngrok Testing

See `docs/NGROK_TESTING.md` for complete instructions.

## Limitations

1. **Refund API**: Not implemented. Refunds must be processed through SSLCommerz dashboard or custom implementation.
2. **Multi-currency**: Only BDT is supported (as required by SSLCommerz for Bangladesh).
3. **Recurring payments**: SSLCommerz recurring billing is not integrated. Manual recurring donations only.
4. **Refund status**: Not tracked in the application.

## Package Limitations

The `SslCommerzNotification` library is a manual recreation from the upstream `sslcommerz/SSLCommerz-Laravel` package. It implements:
- `makePayment()` - Initialize payment
- `orderValidate()` / `validate()` - Validate transaction

**NOT implemented** (from upstream):
- Refund API
- Transaction query API
- Hosted checkout page features

## Security Notes

- Store credentials are never logged or committed
- Raw gateway responses are stored in `gateway_response` field but secrets are not included
- SSL verification is only disabled for localhost development
- All payment amounts are validated server-side
- Database transactions prevent partial updates
