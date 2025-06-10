<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FavoriteController;

// トップページ
Route::get('/', [TopController::class, 'index'])->name('top.index');

// 検索関連
Route::prefix('search')->name('search.')->group(function () {
    Route::get('/{pet_type_id}', [SearchController::class, 'index'])->name('index');
});

// ペット関連
Route::prefix('pet')->name('pet.')->group(function () {
    Route::get('/show/{rescue_pets_id}', [PetController::class, 'show'])->name('show');
    Route::post('/favorite', [PetController::class, 'favorite'])->name('favorite');
});

// 会員関連
Route::prefix('member')->name('member.')->group(function () {
    Route::get('/index', [MemberController::class, 'index'])->name('index');
    Route::post('/create', [MemberController::class, 'create'])->name('create');
    Route::post('/login', [MemberController::class, 'login'])->name('login');
    Route::get('/logout', [MemberController::class, 'logout'])->name('logout');
});

// お気に入り関連
Route::prefix('favorite')->name('favorite.')->group(function () {
    Route::get('/index', [FavoriteController::class, 'index'])->name('index');
});
