<?php

use App\Converters\Converter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/api/converter', function (Request $request) {
    $values = $request->json()->all();

    return [
        'data' => (new Converter)->convert($values['html']),
    ];
});
