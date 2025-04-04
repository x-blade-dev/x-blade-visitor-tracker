<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('visitor-log', function () {
    $filePath = config('visitor-tracker.storage_path', storage_path('app/visitor.json'));
    $visitors = File::exists($filePath) ? json_decode(File::get($filePath), true) : [];

    return view('visitor-tracker::visitor', compact('visitors'));
})->name('visitor.log');

