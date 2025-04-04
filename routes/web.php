<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('visitor-log', function () {
    // Ambil path dari config
    $filePath = config('visitor-tracker.storage_path', storage_path('app/visitor.json'));

    // Baca file JSON jika ada, jika tidak buat array kosong
    $visitors = File::exists($filePath) ? json_decode(File::get($filePath), true) : [];

    return view('xblade-visitor-tracker::visitor', compact('visitors'));
})->name('visitor.log');
