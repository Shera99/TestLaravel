<?php

use App\Http\Controllers\{MemberController, ProjectController};
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

//Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'index'])->name('login');
//
//Route::middleware("auth:web")->group(function () {
//    Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
//});

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/', [ProjectController::class, 'index'])->name('home');
    Route::get('/project/{uuid}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/project/edit/{uuid}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/project/update/{project}', [ProjectController::class, 'update'])->name('project.update');

    Route::post('/project/member/store', [MemberController::class, 'store'])->name('member.store');
    Route::get('/project/member/{id}/delete', [MemberController::class, 'delete'])->name('member.delete');
});

Auth::routes();
