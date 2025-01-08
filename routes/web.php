<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    return view('welcome');
    echo json_encode($_SERVER, JSON_PRETTY_PRINT);
});
