<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanelUserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminPanelBlogPostController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\PasswordResetController;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/admin-panel', fn() => view('admin-panel.index'))->middleware('can:panel-access');

Route::get('/register', [RegistrationController::class, 'create']);
Route::post('/register', [RegistrationController::class, 'store']);

Route::get('/password-reset', [PasswordResetController::class, 'show']);
Route::post('/password-reset', [PasswordResetController::class, 'reset']);
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showNewPassword'])->name('password.reset');
Route::post('/store-new-password', [PasswordResetController::class, 'storeNewPassword']);

Route::get('/login', [SessionsController::class, 'create']);
Route::post('/login', [SessionsController::class, 'store']);
Route::get('/logout', [SessionsController::class, 'destroy']);

Route::get('/posts/{id}', [BlogPostController::class, 'show']);

Route::get('/admin-panel/posts', [AdminPanelBlogPostController::class, 'index'])->middleware('can:post-listing');
Route::get('/admin-panel/posts/create', [AdminPanelBlogPostController::class, 'create'])->middleware('can:post-add');
Route::post('/admin-panel/posts/store', [AdminPanelBlogPostController::class, 'store'])->middleware('can:post-add');
Route::get('/admin-panel/posts/edit/{id}', [AdminPanelBlogPostController::class, 'edit'])->middleware('can:post-edit');
Route::post('/admin-panel/posts/update/{id}', [AdminPanelBlogPostController::class, 'update'])->middleware('can:post-edit');
Route::post('/admin-panel/posts/destroy/{id}', [AdminPanelBlogPostController::class, 'destroy'])
    ->name('admin-panel.posts.destroy')
    ->middleware('can:post-delete');

Route::get('/admin-panel/users', [AdminPanelUserController::class, 'index'])
    ->middleware('can:user-listing');
Route::get('/admin-panel/users/create/', [AdminPanelUserController::class, 'create'])
    ->middleware('can:user-add');
Route::post('/admin-panel/users/store', [AdminPanelUserController::class, 'store'])
    ->middleware('can:user-add');
Route::get('/admin-panel/users/edit/{id}', [AdminPanelUserController::class, 'edit'])
    ->middleware('can:user-edit');
Route::post('/admin-panel/users/update/{id}', [AdminPanelUserController::class, 'update'])
    ->middleware('can:user-edit');
Route::get('/admin-panel/users/edit-password/{id}', [AdminPanelUserController::class, 'editPassword'])
    ->middleware('can:user-edit');
Route::post('/admin-panel/users/update-password/{id}', [AdminPanelUserController::class, 'updatePassword'])
    ->middleware('can:user-edit');
Route::get('/admin-panel/users/edit-roles/{id}', [AdminPanelUserController::class, 'editRoles'])
    ->middleware('can:user-grant-permission');
Route::post('/admin-panel/users/update-roles/{id}', [AdminPanelUserController::class, 'updateRoles'])
    ->middleware('can:user-grant-permission');
Route::post('/admin-panel/users/destroy/{id}', [AdminPanelUserController::class, 'destroy'])
    ->name('admin-panel.users.destroy')
    ->middleware('can:user-delete');
