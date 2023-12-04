<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\PeoplesController;
use Illuminate\Support\Facades\Route;

Route::resource('peoples', PeoplesController::class)->only(
    ['index', 'show', 'store', 'update', 'destroy']
);

Route::resource('pets', PetController::class)->only(
    ['index', 'show', 'store', 'update', 'destroy']
);
