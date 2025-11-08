<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\MembershipController as AdminMembershipController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\UniversityInfoController;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MembershipController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\NoticeController as FrontendNoticeController;
use App\Http\Controllers\Frontend\UniversityController;
use App\Http\Controllers\Frontend\AlumniController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\GuestVerificationController;



/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
// Membership Routes
Route::get('/membership', [MembershipController::class, 'create'])->name('membership.create');
Route::post('/membership', [MembershipController::class, 'store'])->name('membership.store');
Route::get('/membership/status', [MembershipController::class, 'show'])->name('membership.show');
// Events and Notices Routes
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/notices', [FrontendNoticeController::class, 'index'])->name('notices.index');
Route::get('/notices/{notice}', [FrontendNoticeController::class, 'show'])->name('notices.show');
Route::get('/university', [UniversityController::class, 'show'])->name('university.show');
Route::get('/batch', [UniversityController::class, 'showBatchInfo'])->name('batch.show');
Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/alumni/{user}', [AlumniController::class, 'show'])->name('alumni.show');

Route::get('/verify-email-guest', [EmailVerificationPromptController::class, 'guest'])->name('verification.notice.guest');
Route::post('/email/verification-notification-guest', [EmailVerificationNotificationController::class, 'guestStore'])->name('verification.send.guest');
Route::get('/email/verify/guest/{email}', [GuestVerificationController::class, '__invoke'])
    ->middleware(['signed'])
    ->name('verification.verify.guest');


/*
|--------------------------------------------------------------------------
| User Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'can:admin_panel-view'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::resource('hero-banners', HeroBannerController::class);

    // Events and Notices
    Route::resource('notices', NoticeController::class);
    Route::resource('events', AdminEventController::class);
    Route::delete('events/{event}/images/{image}', [AdminEventController::class, 'destroyImage'])->name('events.images.destroy');

    // Membership Routes
    Route::resource('memberships', AdminMembershipController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
    Route::post('memberships/{membership}/approve', [AdminMembershipController::class, 'approve'])->name('memberships.approve');
    Route::post('memberships/{membership}/reject', [AdminMembershipController::class, 'reject'])->name('memberships.reject');

    // University Info Routes
    Route::get('university-info', [UniversityInfoController::class, 'edit'])->name('university-info.edit');
    Route::put('university-info/textual', [UniversityInfoController::class, 'updateTextualInfo'])->name('university-info.update.textual');
    Route::post('university-info/university-images', [UniversityInfoController::class, 'updateUniversityImages'])->name('university-info.update.university-images');
    Route::post('university-info/batch-images', [UniversityInfoController::class, 'updateBatchImages'])->name('university-info.update.batch-images');
    Route::delete('university-info/image/{field}', [UniversityInfoController::class, 'destroyImage'])->name('university-info.image.destroy');
});
