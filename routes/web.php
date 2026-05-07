<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', [
        // 'name' => 'Goja'
    ]);
});

Route::get('/hello', function () {
    return 'Hello';
})->name('hello');

Route::get('/hallo', function () {
    return redirect('/hello');
});

Route::get('/greet/{name}', function ($name) {
    return 'Hallo ' . $name;
});

Route::fallback(function () {
    return 'No Route';
});
