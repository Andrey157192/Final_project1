<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/forms', function () {
    return view('pages.forms.index');
});

Route::get('/buttons', function () {
    return view('pages.ui-features.buttons.index');
});

Route::get('/dropdowns', function () {
    return view('pages.ui-features.dropdowns.index');
});

Route::get('/typography', function () {
    return view('pages.ui-features.typography.index');
});

Route::get('/chart', function () {
    return view('pages.chart.index');
});

Route::get('/table', function () {
    return view('pages.table.index');
});

Route::get('/icons', function () {
    return view('pages.icons.index');
});

Route::get('/login', function () {
    return view('pages.user-pages.login.index');
});

Route::get('/register', function () {
    return view('pages.user-pages.register.index');
});

Route::get('/erro404', function () {
    return view('pages.error-pages.404.index');
});

Route::get('/erro500', function () {
    return view('pages.error-pages.500.index');
});


//dashboard
// CRUD Rooms
Route::get('/admin/rooms', [DashboardController::class,'rooms'])->name('admin.rooms.index');
Route::post('/admin/rooms', [DashboardController::class,'storeRoom'])->name('admin.rooms.store');
Route::put('/admin/rooms/{room}', [DashboardController::class,'updateRoom'])->name('admin.rooms.update');
Route::delete('/admin/rooms/{room}', [DashboardController::class,'destroyRoom'])->name('admin.rooms.destroy');

// front pages sesuai sidebar
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/about', [DashboardController::class, 'about'])->name('about');


// About CRUD
Route::get ('/admin/about',            [DashboardController::class,'about'])->name('admin.about');
Route::put ('/admin/about/settings',   [DashboardController::class,'updateAbout'])->name('admin.about.update');

// Leadership CRUD
Route::post   ('/admin/about/leadership',                [DashboardController::class,'storeLeadership'])->name('admin.leadership.store');
Route::put    ('/admin/about/leadership/{leadership}',   [DashboardController::class,'updateLeadership'])->name('admin.leadership.update');
Route::delete ('/admin/about/leadership/{leadership}',   [DashboardController::class,'destroyLeadership'])->name('admin.leadership.destroy');

// Hotel View CRUD
Route::post   ('/admin/about/views',                     [DashboardController::class,'storeView'])->name('admin.views.store');
Route::delete ('/admin/about/views/{view}',              [DashboardController::class,'destroyView'])->name('admin.views.destroy');

// List & form
Route::get('/admin/events',       [DashboardController::class, 'listEvents'])->name('events.index');
// Simpan
Route::post('/admin/events',      [DashboardController::class, 'storeEvent'])->name('events.store');
// Detail
Route::get('/admin/events/{event}', [DashboardController::class, 'showEvent'])->name('events.show');
// Update
Route::put('/admin/events/{event}', [DashboardController::class, 'updateEvent'])->name('events.update');
// Delete
Route::delete('/admin/events/{event}', [DashboardController::class, 'destroyEvent'])->name('events.destroy');
Route::get('/contact', [DashboardController::class, 'contact'])->name('contact');
// Admin Ulasan Routes
Route::get('/admin/ulasan', [DashboardController::class, 'indexUlasan'])->name('admin.ulasan.index');
Route::post('/admin/ulasan/{id}/toggle', [DashboardController::class, 'toggleUlasan'])->name('admin.ulasan.toggle');


// Data User CRUD
Route::get('/dashboard/admin/users', [DashboardController::class, 'users'])->name('datauser.index');
Route::post('/dashboard/admin/users', [DashboardController::class, 'storeUser'])->name('datauser.store');
Route::get('/dashboard/admin/users/{user}/edit', [DashboardController::class, 'editUser'])->name('datauser.edit');
Route::put('/dashboard/admin/users/{user}', [DashboardController::class, 'updateUser'])->name('datauser.update');
Route::delete('/dashboard/admin/users/{user}', [DashboardController::class, 'destroyUser'])->name('datauser.destroy');

    

