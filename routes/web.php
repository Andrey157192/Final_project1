<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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
// Route::get('/',[AdminController::class,'dashboard'])->name('admin.dashboard');
Route::get('/agent/dashboard',[AgentController::class,'dashboard'])->name('agent.dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registerpost');

//admin routes
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/home',[AdminController::class,'home'])->name('admin.home');
    Route::get('/admin/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
    Route::get('/admin/about', [AdminController::class, 'about'])->name('admin.about');
    Route::get('/admin/events', [AdminController::class, 'events'])->name('admin.events');
    Route::get('/admin/contacts', [AdminController::class, 'contacts'])->name('admin.contacts');
    Route::get('/admin/reservation', [AdminController::class, 'reservation'])->name('admin.reservation');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/roar', [DashboardController::class, 'index']);

});

//agent routes
Route::middleware(['auth','role:agent'])->group(function () {
    Route::get('/agent/dashboard',[AgentController::class,'dashboard'])->name('agent.dashboard');
});

//user routes
Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'home']); 

    
    });


Route::get ('/', function () {
    return view('user.pages.index');
});
Route::get('/about', function () {
    return view('user.pages.about');
});

Route::get('/rooms', function () {
    return view('user.pages.rooms');
});

Route::get('/events', function () {
    return view('user.pages.events');
});

Route::get('/contact', function () {
    return view('user.pages.contact');
});
<<<<<<< HEAD
=======

// Route::get('/reservation', function () {
//     return view('user.pages.reservation');
// });
=======
Route::get('/', function () {
    return view('dasboard.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['role:staff'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
>>>>>>> main
>>>>>>> b4e1cac23bd4767b5d66fefefca72c8c889187db
