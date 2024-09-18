<?php

use App\Http\Controllers\Back\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('back.dashboard.index');
});

Route::resource('/categories', CategoryController::class)->only(['index', 'update', 'create', 'show', 'store', 'destroy']);
