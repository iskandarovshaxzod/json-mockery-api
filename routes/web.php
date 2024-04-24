<?php

use App\Models\Centre;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
