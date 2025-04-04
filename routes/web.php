<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;

Route::get('/api/visitor-count', function () {
    $filePath = config('visitor-tracker.storage_path', storage_path('app/visitor.json'));
    $visitors = File::exists($filePath) ? json_decode(File::get($filePath), true) : [];

    $today = Carbon::today();
    $todayVisitors = collect($visitors)->filter(function ($visitor) use ($today) {
        return Carbon::parse($visitor['time'])->isSameDay($today);
    })->values()->all();

    return response()->json([
        'count' => count($todayVisitors),
        'visitors' => $todayVisitors,
    ]);
});
