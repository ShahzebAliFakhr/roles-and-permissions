<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

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

// Login
Route::get('/', function () {
    if(Auth::check()){
        return redirect('dashboard');
    }else{
        return view('auth.login');
    }
})->name('login');
Route::post('login', [AuthController::class, 'login']);

// Register
Route::get('register', function () {
    if(Auth::check()){
        return redirect('dashboard');
    }else{
        $data['roles'] = \App\Models\Role::whereNot('id', 1)->get()->toArray();
        return view('auth.register', $data);
    }
})->name('register');
Route::post('register', [AuthController::class, 'register']);

// Logout
Route::get('logout', function () {
    Session::flush();
    Auth::logout();
    return redirect('/');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('profile/update', [AuthController::class, 'profile_update']);

    // Roles
    Route::get('roles', [RoleController::class, 'index'])->middleware('CheckPermission:role_read');
    Route::prefix('role')->group(function () {
        Route::get('create', [RoleController::class, 'create'])->middleware('CheckPermission:role_create');
        Route::post('save', [RoleController::class, 'save'])->middleware('CheckPermission:role_create');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->middleware('CheckPermission:role_update');
        Route::post('update', [RoleController::class, 'update'])->middleware('CheckPermission:role_update');
        Route::get('delete/{id}', [RoleController::class, 'delete'])->middleware('CheckPermission:role_delete');
        Route::get('detail/{id}', [RoleController::class, 'detail'])->middleware('CheckPermission:role_read');
        Route::get('permissions/{id}', [RoleController::class, 'permissions'])->middleware('CheckPermission:role_read');
        Route::post('permissions/update', [RoleController::class, 'permissions_update'])->middleware('CheckPermission:role_update');
    });

});

Route::get('login-as-user/{id}', [AuthController::class, 'loginAsUser']);