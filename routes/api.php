<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('categories', 'Api\CategoryController')->except(['edit', 'create']);
Route::resource('genres', 'Api\GenreController')->except(['edit', 'create']);
