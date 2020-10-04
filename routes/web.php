<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/api/services/', [\App\Http\Controllers\ProductsControloler::class, 'list']);
    Route::post('/api/services/add', [\App\Http\Controllers\ProductsControloler::class, 'add']);

    //CheckProductUserBelongsUser создан для проверки к своему ли продукту обращается авторизованный пользователь
    //Такое решение из-за того что чувствительные параметры передаются в самом запросе.
    Route::middleware([\App\Http\Middleware\CheckProductUserBelongsUser::class])->group(function () {
        Route::get('/api/services/edit/{id}', [\App\Http\Controllers\ProductsControloler::class, 'edit']);
        Route::get('/api/services/delete/{id}', [\App\Http\Controllers\ProductsControloler::class, 'delete']);

        //  я бы объединил методы upgrade и downgrade в один и сделал бы проверку на downgrade внутри
//    это позволит использовать один роут и не указывать разные роуты во вьюшке, добавляя логику.
//    т.е. использую текущее апи, придется чекать это downgrade или upgrade в момент запроса
        Route::post('/api/services/upgrade/{id}/{product_id}', [\App\Http\Controllers\ProductsControloler::class, 'upgrade']);
        Route::post('/api/services/downgrade/{id}/{product_id}', [\App\Http\Controllers\ProductsControloler::class, 'downgrade']);
    });
});

