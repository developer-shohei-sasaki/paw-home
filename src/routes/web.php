<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TopController;

Route::get('/', [TopController::class, 'index'])->name('top.index');
