<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RevisorController;

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



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/annunci', [AdController::class, 'create'])->name('ads.form');
Route::post('/ad/images/upload', [AdController::class, 'upload'])->name('ads.form.upload');
Route::delete('/ad/images/remove', [AdController::class, 'remove'])->name('ads.form.remove');
Route::get('/ad/images', [AdController::class, 'getImages'])->name('ads.images');
Route::post('/aggiungi', [AdController::class, 'store'])->name('ads.store');
Route::get('/dettaglio/{ad}/{title}', [AdController::class, 'show'])->name('ads.show');
Route::get('/cerca-categoria/{category}', [HomeController::class, 'search'])->name('category.search');
Route::get('/candidati', [AdController::class, 'revisor'])->name('revisor.form');
Route::post('/candidati/submit', [AdController::class, 'submit'])->name('revisor.submit');
Route::get('/revisor/home', [RevisorController::class, 'index'])->name('revisor.home');
Route::put('/revisor/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');
Route::put('/revisor/{ad}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');
Route::put('/revisor/{trash}/undo', [RevisorController::class, 'undo'])->name('revisor.undo');
Route::get('/search', [AdController::class, 'search'])->name('search');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.panel');
Route::put('/admin/{user}/setRevisor', [AdminController::class, 'setRevisor'])->name('revisor.set');
Route::put('/admin/{user}/removeRevisor', [AdminController::class, 'removeRevisor'])->name('revisor.remove');
Route::post('/locale/{locale}', [HomeController::class, 'locale'])->name('locale');
Route::delete('/revisor/{t}/delete', [RevisorController::class, 'destroy'])->name('revisor.delete');
Route::get('/profilo', [UserController::class, 'profile'])->name('user.profile');