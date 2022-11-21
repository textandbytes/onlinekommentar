<?php

use Textandbytes\Converter\Converter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('converter/convert', function (Request $request) {
    $values = $request->json()->all();

    return [
        'data' => (new Converter)->convert($values['html']),
    ];
});
