<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'editPost'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::patch('projects/{id}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggleStatus');
    Route::match(['get', 'post'], 'projects/collection/entry', [ProjectController::class, 'collection_entry'])->name('projects.collectionEntry');
    // User
    Route::resource('user', UserController::class);
    Route::get('user-datatable', [UserController::class, 'dataTable'])->name('user.datatable');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Permission
    Route::resource('permission', PermissionController::class);
    Route::get('permission-datatable', [PermissionController::class, 'dataTable'])->name('permission.datatable');

    // Role
    Route::resource('role', RoleController::class);
    Route::get('role-datatable', [RoleController::class, 'dataTable'])->name('role.datatable');
    Route::get('user-assign-role', [RoleController::class, 'userAssignRole'])->name('user_assign_role');
    Route::post('user-assign-role', [RoleController::class, 'userAssignRoleStore'])->name('user_assign_role.store');
});

require __DIR__ . '/auth.php';



Route::get('/clear', function () {
    Artisan::call('cache:forget spatie.permission.cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return redirect()->back()->with('success', 'Cache Cleared!');
})->name('clear');
