<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Staff\StaffController;
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

Auth::routes(['register' => false, 'verify' => true]);

# Route for all logged in users
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [IndexController::class, 'index']);
});

# Admin Routes
Route::group(['middleware' => ['auth-user-role:admin'], 'as' => 'admin.','prefix'=>'admin'], function () {

    Route::prefix('staff')->group(function () {
        Route::get('/list', [AdminController::class, 'listStaff'])->name('listStaff');

        Route::get('/policies/{id}', [AdminController::class, 'staffPolicies'])->name('staffPolicies');
        Route::post('/add-policies', [AdminController::class, 'addPolicies'])->name('addPolicies');
        Route::delete('/remove-policy', [AdminController::class, 'removePolicy'])->name('removePolicy');
        Route::delete('/remove', [AdminController::class, 'removeStaff'])->name('removeStaff');
    });


    Route::post('/admin/create-account', [AdminController::class, 'createAccount'])->name('createAccount');
});

# Staff user Routes
Route::group(['middleware' => ['auth-user-role:staff'],'as' => 'staff.'], function () {
    Route::get('/staff/polices', [StaffController::class, 'polices'])->name('polices');
    Route::get('/staff/polices/{id}', [StaffController::class, 'singlePolicy'])->name('single-policy');
});

