<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::get('/reservation', function () {
    return view('user.pages.reservation');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['role:staff'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/room/single', function () {
    return view('room.single'); // Ganti 'room.single' dengan path view kamu
});
Route::get('/room/family', function () {
    return view('room.family'); // Ganti 'room.double' dengan path view kamu
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
Route::get('/admin/datauser/export', [DashboardController::class, 'export'])->name('datauser.export');




