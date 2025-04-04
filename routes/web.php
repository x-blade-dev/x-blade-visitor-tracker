<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/api/visitor-count', function () {
    $filePath = config('visitor-tracker.storage_path', storage_path('app/visitor.json'));
    $visitors = File::exists($filePath) ? json_decode(File::get($filePath), true) : [];

    $today = now()->format('Y-m-d');
    $count = collect($visitors)->filter(fn($v) => str_starts_with($v['time'], $today))->count();

    return response()->json(['count' => $count]);
});
