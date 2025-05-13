<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// AUTH ROUTES (Login, Register, Logout)

Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registerpost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// PUBLIC USER ROUTES
Route::get('/',[UserController::class,'index']);


Route::get('/about-user', [UserController::class, 'about'])->name('aboutuser');
Route::get('/rooms', [UserController::class, 'rooms'])->name('roomsuser');
Route::get('/room/single{id}', [UserController::class, 'roomsDetail'])->name('room.detail');

Route::get('/events', [UserController::class, 'events'])->name('user.events');
Route::get('/contact', fn () => view('user.pages.contact'));
Route::get('/reservation', fn () => view('user.pages.reservation'));

Route::get('/room/kamar1', fn () => view('room.kamar1'));
Route::get('/room/kamar2', fn () => view('room.kamar2'));
Route::get('/room/kamar3', fn () => view('room.kamar3'));
Route::get('/room/kamar4', fn () => view('room.kamar4'));
Route::get('/room/kamar5', fn () => view('room.kamar5'));
Route::get('/room/kamar6', fn () => view('room.kamar6'));

// ==========================
// AUTH MIDDLEWARE PROTECTED PROFILE ROUTES
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// STAFF DASHBOARD (ROLE:staff)
// ==========================
Route::get('/dashboard', fn () => view('dashboard.index'))->middleware(['role:staff'])->name('dashboard');

// ==========================
// AGENT ROUTES (ROLE:agent)
// ==========================
Route::middleware(['auth','role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
});

// ==========================
// USER ROUTES (ROLE:user)
// ==========================
Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'home']);


});

// ==========================
// ADMIN ROUTES (ROLE:admin)
// ==========================
Route::middleware(['auth','role:admin'])->group(function () {

    // === Dashboard & General Pages ===
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/admin/reservation', [AdminController::class, 'reservation'])->name('admin.reservation');
    Route::get('/admin/contacts', [AdminController::class, 'contacts'])->name('admin.contacts');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/roar', [DashboardController::class, 'index']);

    // === Front Pages ===
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/about', [DashboardController::class, 'about'])->name('about');

    Route::get('/contact', [DashboardController::class, 'contact'])->name('contact');

    // === ROOMS ===
    Route::get('/admin/rooms', [DashboardController::class,'rooms'])->name('admin.rooms.index');
    Route::post('/admin/rooms', [DashboardController::class,'storeRoom'])->name('admin.rooms.store');
    Route::put('/admin/rooms/{room}', [DashboardController::class,'updateRoom'])->name('admin.rooms.update');
    Route::delete('/admin/rooms/{room}', [DashboardController::class,'destroyRoom'])->name('admin.rooms.destroy');

    // === EVENTS ===
    Route::get('/admin/events', [DashboardController::class, 'listEvents'])->name('events.index');
    Route::post('/admin/events', [DashboardController::class, 'storeEvent'])->name('events.store');
    Route::get('/admin/events/{event}', [DashboardController::class, 'showEvent'])->name('events.show');
    Route::put('/admin/events/{event}', [DashboardController::class, 'updateEvent'])->name('events.update');
    Route::delete('/admin/events/{event}', [DashboardController::class, 'destroyEvent'])->name('events.destroy');

    // === ABOUT / HOTEL INFO ===
    Route::get('/admin/about', [DashboardController::class,'about'])->name('admin.about');
    Route::put('/admin/about/settings', [DashboardController::class,'updateAbout'])->name('admin.about.update');

    // Leadership
    Route::post('/admin/about/leadership', [DashboardController::class,'storeLeadership'])->name('admin.leadership.store');
    Route::put('/admin/about/leadership/{leadership}', [DashboardController::class,'updateLeadership'])->name('admin.leadership.update');
    Route::delete('/admin/about/leadership/{leadership}', [DashboardController::class,'destroyLeadership'])->name('admin.leadership.destroy');

    // Hotel Views
    Route::post('/admin/about/views', [DashboardController::class,'storeView'])->name('admin.views.store');
    Route::delete('/admin/about/views/{view}', [DashboardController::class,'destroyView'])->name('admin.views.destroy');

    // === ULASAN / REVIEWS ===
    Route::get('/admin/ulasan', [DashboardController::class, 'indexUlasan'])->name('admin.ulasan.index');
    Route::post('/admin/ulasan/{id}/toggle', [DashboardController::class, 'toggleUlasan'])->name('admin.ulasan.toggle');

    // === USERS ===
    Route::get   ('admin/reservasi',            [DashboardController::class, 'indexReservasi'])->name('reservasi.index');
    Route::post  ('admin/reservasi',            [DashboardController::class, 'storeReservasi'])->name('reservasi.store');
    Route::get   ('admin/reservasi/{id}/edit',  [DashboardController::class, 'editReservasi'])->name('reservasi.edit');
    Route::put   ('admin/reservasi/{id}',       [DashboardController::class, 'updateReservasi'])->name('reservasi.update');
    Route::delete('admin/reservasi/{id}',       [DashboardController::class, 'destroyReservasi'])->name('reservasi.destroy');


    // === RATINGS ===
    Route::get('/admin/ratings', [RatingController::class, 'index'])->name('admin.ratings');
    Route::post('/admin/ratings/{id}/approve', [RatingController::class, 'approve'])->name('ratings.approve');

    // Admin Rating Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/ratings', [RatingController::class, 'adminIndex'])->name('admin.ratings');
        Route::post('/admin/ratings/{id}/approve', [RatingController::class, 'approve'])->name('admin.ratings.approve');
        Route::delete('/admin/ratings/{id}', [RatingController::class, 'destroy'])->name('admin.ratings.destroy');
    });

});
Route::post('/book-now', [BookingController::class, 'booking'])->name('book.now')->middleware('auth');

// Rating Routes
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// Rating routes
Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store')->middleware('auth');

// Admin rating routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/ratings', [RatingController::class, 'adminIndex'])->name('admin.ratings');
    Route::post('/admin/ratings/{id}/approve', [RatingController::class, 'approve'])->name('admin.ratings.approve');
    Route::delete('/admin/ratings/{id}', [RatingController::class, 'destroy'])->name('admin.ratings.destroy');
});
