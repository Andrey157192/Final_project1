<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


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
Route::get('/dashboard/admin',[DashboardController::class,'index']);
Route::get('/dashboard/admin/rooms',[DashboardController::class,'rooms']);

// front pages sesuai sidebar
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/about', [DashboardController::class, 'about'])->name('about');
Route::get('/events', [DashboardController::class, 'events'])->name('events');
Route::get('/contact', [DashboardController::class, 'contact'])->name('contact');
Route::get('/rating', [DashboardController::class, 'rating'])->name('rating');
Route::post('/rating', [DashboardController::class, 'store'])->name('rating.store');
Route::get('/rating', [DashboardController::class, 'rating'])->name('rating');
Route::post('/rating', [DashboardController::class, 'store'])->name('rating.store');

// Data User CRUD
Route::get('/dashboard/admin/users', [DashboardController::class, 'users'])->name('datauser.index');
Route::post('/dashboard/admin/users', [DashboardController::class, 'storeUser'])->name('datauser.store');
Route::get('/dashboard/admin/users/{user}/edit', [DashboardController::class, 'editUser'])->name('datauser.edit');
Route::put('/dashboard/admin/users/{user}', [DashboardController::class, 'updateUser'])->name('datauser.update');
Route::delete('/dashboard/admin/users/{user}', [DashboardController::class, 'destroyUser'])->name('datauser.destroy');

    

