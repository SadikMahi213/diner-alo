<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\ActivitiesController;
use App\Http\Controllers\Front\ProgramsController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\GalleryController;
use App\Http\Controllers\Front\DonationController;
use App\Http\Controllers\Front\VolunteerController;
use App\Http\Controllers\Front\MembershipController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\User\PaymentController as UserPaymentController;
use App\Http\Controllers\Admin\DinersAloDashboardController;
use App\Http\Controllers\Admin\DonationFundController;
use App\Http\Controllers\SslCommerzPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication routes (using laravel/ui)
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Frontend routes (public, no auth required)
Route::middleware(['web'])->group(function () {
    // Homepage
    Route::get('/', [LandingController::class, 'index'])->name('home');

    // About
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    // Activities & Programs
    Route::get('/activities', [ActivitiesController::class, 'index'])->name('activities');
    Route::get('/programs', [ProgramsController::class, 'index'])->name('programs');

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');

    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

    // Donation (reference workflow: fund → contact → amount → gateway portal → result → receipt)
    Route::get('/donation', [DonationController::class, 'create'])->name('donation.create');
    Route::post('/donation/sslcommerz/initiate', [DonationController::class, 'initiateSslCommerz'])->name('donation.sslcommerz.initiate');
    Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');
    Route::get('/donation/portal/{id}', [DonationController::class, 'portal'])->name('donation.portal');
    Route::get('/donation/success/{id}', [DonationController::class, 'showSuccess'])->name('donation.success');
    Route::get('/donation/failed/{id}', [DonationController::class, 'showFailed'])->name('donation.failed');
    Route::get('/donation/cancelled/{id}', [DonationController::class, 'showCancelled'])->name('donation.cancelled');
    Route::get('/donation/receipt/{id}', [DonationController::class, 'receipt'])->name('donation.receipt');
    Route::get('/donation/download-receipt/{id}', [DonationController::class, 'downloadReceipt'])->name('donation.download-receipt');

    // Volunteer
    Route::get('/volunteer', [VolunteerController::class, 'create'])->name('volunteer.create');
    Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
    Route::get('/volunteer/thankyou', [VolunteerController::class, 'thankyou'])->name('volunteer.thankyou');

    // Membership
    Route::get('/membership', [MembershipController::class, 'create'])->name('membership.create');
    Route::post('/membership', [MembershipController::class, 'store'])->name('membership.store');
    Route::get('/membership/thankyou/{id}', [MembershipController::class, 'thankyou'])->name('membership.thankyou');

    // Zakat
    Route::get('/zakat', function () {
        return view('front.zakat.index');
    })->name('zakat');

    // SSLCommerz Callback URLs (success/fail/cancel are GET browser redirects; IPN is POST server-to-server)
    Route::match(['get', 'post'], '/sslcommerz/success', [SslCommerzPaymentController::class, 'success'])->name('sslcommerz.success');
    Route::match(['get', 'post'], '/sslcommerz/fail', [SslCommerzPaymentController::class, 'fail'])->name('sslcommerz.fail');
    Route::match(['get', 'post'], '/sslcommerz/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('sslcommerz.cancel');
    Route::post('/sslcommerz/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('sslcommerz.ipn');
});

// Home route redirect
Route::get('/home', function () {
    return redirect()->route('home');
})->name('home.redirect');

// User Dashboard Routes (requires auth)
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/packages', [\App\Http\Controllers\User\DashboardController::class, 'packages'])->name('user.packages');
    Route::get('/orders', [\App\Http\Controllers\User\DashboardController::class, 'orders'])->name('user.orders');
    Route::get('/transactions', [\App\Http\Controllers\User\DashboardController::class, 'transactions'])->name('user.transactions');
    Route::get('/wallet', [\App\Http\Controllers\User\DashboardController::class, 'wallet'])->name('user.wallet');

    // Package Checkout
    Route::get('/packages/checkout/{package}', [UserPaymentController::class, 'checkout'])->name('user.checkout');
    Route::post('/packages/{package}/pay', [UserPaymentController::class, 'pay'])->name('user.pay');
});

// Admin Routes (requires auth + admin middleware)
Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DinersAloDashboardController::class, 'index'])->name('admin.dashboard');
    // HTML admin pages (server-rendered Blade)
    Route::get('/admin/donations', [\App\Http\Controllers\Admin\DonationController::class, 'index'])->name('admin.donations');
    Route::get('/admin/donations/{donation}', [\App\Http\Controllers\Admin\DonationController::class, 'show'])->name('admin.donations.show');
    Route::get('/admin/donors', [\App\Http\Controllers\Admin\DonorController::class, 'index'])->name('admin.donors');
    Route::get('/admin/donors/{donor}', [\App\Http\Controllers\Admin\DonorController::class, 'show'])->name('admin.donors.show');
    Route::get('/admin/members', [\App\Http\Controllers\Admin\MembershipController::class, 'index'])->name('admin.members');
    Route::get('/admin/members/{member}', [\App\Http\Controllers\Admin\MembershipController::class, 'show'])->name('admin.members.show');
    Route::get('/admin/volunteers', [\App\Http\Controllers\Admin\VolunteerController::class, 'index'])->name('admin.volunteers');
    Route::get('/admin/volunteers/{volunteer}', [\App\Http\Controllers\Admin\VolunteerController::class, 'show'])->name('admin.volunteers.show');
    // JSON/DataTables endpoints (for AJAX)
    Route::get('/admin/donations/data', [DinersAloDashboardController::class, 'donationsDatatable'])->name('admin.donations.data');
    Route::get('/admin/projects', [DinersAloDashboardController::class, 'projectsDatatable'])->name('admin.projects');
    Route::get('/admin/donors/data', [DinersAloDashboardController::class, 'donorsDatatable'])->name('admin.donors.data');
    Route::get('/admin/volunteers/data', [DinersAloDashboardController::class, 'volunteersDatatable'])->name('admin.volunteers.data');
    Route::get('/admin/members/data', [DinersAloDashboardController::class, 'membersDatatable'])->name('admin.members.data');
    Route::get('/admin/contacts', [DinersAloDashboardController::class, 'contactMessagesDatatable'])->name('admin.contacts');
    Route::get('/admin/statistics', [DinersAloDashboardController::class, 'statisticsData'])->name('admin.statistics');
    Route::get('/admin/export/donations', [DinersAloDashboardController::class, 'exportDonations'])->name('admin.export.donations');
    Route::get('/admin/export/members', [DinersAloDashboardController::class, 'exportMembers'])->name('admin.export.members');

    // Packages
    Route::get('/admin/packages', [\App\Http\Controllers\Admin\PackageController::class, 'index'])->name('admin.packages');
    Route::get('/admin/packages/create', [\App\Http\Controllers\Admin\PackageController::class, 'create'])->name('admin.packages.create');
    Route::post('/admin/packages', [\App\Http\Controllers\Admin\PackageController::class, 'store'])->name('admin.packages.store');
    Route::get('/admin/packages/{package}/edit', [\App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('/admin/packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'update'])->name('admin.packages.update');
    Route::delete('/admin/packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'destroy'])->name('admin.packages.destroy');

    // Donation Funds
    Route::get('/admin/donation-funds', [DonationFundController::class, 'index'])->name('admin.donation-funds.index');
    Route::get('/admin/donation-funds/create', [DonationFundController::class, 'create'])->name('admin.donation-funds.create');
    Route::post('/admin/donation-funds', [DonationFundController::class, 'store'])->name('admin.donation-funds.store');
    Route::get('/admin/donation-funds/{donationFund}/edit', [DonationFundController::class, 'edit'])->name('admin.donation-funds.edit');
    Route::put('/admin/donation-funds/{donationFund}', [DonationFundController::class, 'update'])->name('admin.donation-funds.update');
    Route::delete('/admin/donation-funds/{donationFund}', [DonationFundController::class, 'destroy'])->name('admin.donation-funds.destroy');
    Route::post('/admin/donation-funds/{donationFund}/toggle', [DonationFundController::class, 'toggle'])->name('admin.donation-funds.toggle');

    // Transactions
    Route::get('/admin/transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transactions.index');
    Route::get('/admin/transactions/{transaction}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('admin.transactions.show');

    // Orders
    Route::get('/admin/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');

    // Users
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users/{user}/toggle', [\App\Http\Controllers\Admin\UserController::class, 'toggle'])->name('admin.users.toggle');

    // Members - approve workflow
    Route::post('/admin/members/{member}/approve', [\App\Http\Controllers\Admin\MembershipController::class, 'approve'])->name('admin.members.approve');
    Route::post('/admin/members/{member}/reject', [\App\Http\Controllers\Admin\MembershipController::class, 'reject'])->name('admin.members.reject');
    Route::post('/admin/members/{member}/deactivate', [\App\Http\Controllers\Admin\MembershipController::class, 'deactivate'])->name('admin.members.deactivate');

    // Volunteers - approve workflow
    Route::post('/admin/volunteers/{volunteer}/approve', [\App\Http\Controllers\Admin\VolunteerController::class, 'approve'])->name('admin.volunteers.approve');
    Route::post('/admin/volunteers/{volunteer}/reject', [\App\Http\Controllers\Admin\VolunteerController::class, 'reject'])->name('admin.volunteers.reject');
    Route::post('/admin/volunteers/{volunteer}/deactivate', [\App\Http\Controllers\Admin\VolunteerController::class, 'deactivate'])->name('admin.volunteers.deactivate');

    // Courses
    Route::get('/admin/courses', [\App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/admin/courses/create', [\App\Http\Controllers\Admin\CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/admin/courses', [\App\Http\Controllers\Admin\CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/admin/courses/{course}/edit', [\App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/admin/courses/{course}', [\App\Http\Controllers\Admin\CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/admin/courses/{course}', [\App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('admin.courses.destroy');
});
