<?php

Route::group(['prefix' => 'api/v1', 'middleware' => ['cors']], function () {
    Route::resource('thumb', 'Kingkong\Foundation\Http\Controllers\ThumbController', ['only'=>['show']]);
});