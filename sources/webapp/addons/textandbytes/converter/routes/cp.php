<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Statamic\Facades\Entry;
use Textandbytes\Converter\Converter;

Route::post('converter/html-prosemirror', function (Request $request) {
    $values = $request->json()->all();
    $data = (new Converter)->htmlToProsemirror($values['html']);

    return ['data' => $data];
});

Route::post('converter/prosemirror-word', function (Request $request) {
    $values = $request->json()->all();
    $entry = Entry::find($values['id']);
    $file = (new Converter)->prosemirrorToWord($values['data']);

    return response()
        ->download($file, "{$entry->slug}.docx")
        ->deleteFileAfterSend(true);
});

Route::post('converter/entry-word', function (Request $request) {
    $values = $request->json()->all();
    $entry = Entry::find($values['id']);
    $file = (new Converter)->entryToWord($entry);

    return response()
        ->download($file, "{$entry->slug}.docx")
        ->deleteFileAfterSend(true);
});
