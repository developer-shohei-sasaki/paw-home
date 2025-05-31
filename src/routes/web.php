<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TopController;
use \App\Http\Controllers\SearchController;
use \App\Http\Controllers\PetController;

Route::get('/', [TopController::class, 'index'])->name('top.index');

Route::get('/search/{pet_type_id}', [SearchController::class, 'index'])->name('search.index');

Route::get('/pet/show/{rescue_pets_id}', [PetController::class, 'show'])->name('pet.show');
Route::post('/pet/favorite', [PetController::class, 'favorite'])->name('pet.favorite');
