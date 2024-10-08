<?php

use App\Http\Controllers\Frontend\CourseController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('coming-soon');
})->name('coming-soon');

// Only enable these routes for the user with id 1
Route::middleware([EnsureIsAdmin::class])->group(function () {
    Route::get('/home', function () {
        return view('frontend.pages.home');
    })->name('home');

    Route::get('/pricing', function () {
        return view('frontend.pages.pricing');
    })->name('pricing');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{courseSlug}/lessons/{lessonSlug}', [CourseController::class, 'showLesson'])->name('courses.show-lesson');

    Route::get('/terms-of-use', function () {
        $termsContent = File::get(resource_path('markdown/terms.md'));
        return view('frontend.pages.legal.terms', compact('termsContent'));
    })->name('legal.terms');

    Route::get('/privacy-policy', function () {
        $policyContent = File::get(resource_path('markdown/policy.md'));
        return view('frontend.pages.legal.policy', compact('policyContent'));
    })->name('legal.policy');
});

Route::group(['prefix' => 'account', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('frontend.pages.account.account');
    })->name('account.account');

    Route::get('/settings', function () {
        return view('frontend.pages.account.settings');
    })->name('account.settings');

    Route::get('/subscription', function (Request $request) {
        return $request->user()
            ->newSubscription('basic', config('trincheradev.stripe_basic_price_id'))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('home'),
                'cancel_url' => route('account.account'),
            ]);
    })->name('account.subscription');

    Route::get('/billing', function (Request $request){
        return $request->user()->redirectToBillingPortal(route('dashboard'));
    })->middleware(['auth'])->name('billing');

    Route::get('/billing-portal', function (Request $request) {
        return $request->user()->redirectToBillingPortal(route('billing'));
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    EnsureIsAdmin::class
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/users', function () {
        return view('dashboard.users.page');
    })->name('dashboard-users');

    Route::get('/dashboard/courses', function () {
        return view('dashboard.courses.page');
    })->name('dashboard-courses');

    Route::get('/dashboard/courses/add', function () {
        return view('dashboard.courses.courses.add');
    })->name('dashboard-courses-add');
});
