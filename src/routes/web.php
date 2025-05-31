<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TopController;
use \App\Http\Controllers\SearchController;
use \App\Http\Controllers\PetController;
use \App\Http\Controllers\MemberController;
use \App\Http\Controllers\FavoriteController;

Route::get('/', [TopController::class, 'index'])->name('top.index');

Route::get('/search/{pet_type_id}', [SearchController::class, 'index'])->name('search.index');

Route::get('/pet/show/{rescue_pets_id}', [PetController::class, 'show'])->name('pet.show');
Route::post('/pet/favorite', [PetController::class, 'favorite'])->name('pet.favorite');

Route::get('/member/index', [MemberController::class, 'index'])->name('member.index');
Route::post('/member/create', [MemberController::class, 'create'])->name('member.create');
Route::post('/member/login', [MemberController::class, 'login'])->name('member.login');
Route::get('/member/logout', [MemberController::class, 'logout'])->name('member.logout');

Route::get('/favorite/index', [FavoriteController::class, 'index'])->name('favorite.index');
