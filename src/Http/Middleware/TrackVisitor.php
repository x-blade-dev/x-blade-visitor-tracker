<?php

namespace XBlade\VisitorTracker\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // 🔹 Cek apakah logging diaktifkan dalam config
        if (!Config::get('visitor-tracker.enabled', true)) {
            return $next($request);
        }

        // 🔹 Daftar IP yang tidak dicatat
        $excludedIps = Config::get('visitor-tracker.excluded_ips', []);

        // 🔹 Daftar path/URL yang tidak ingin dicatat (misalnya AJAX API)
        $excludedPaths = [
            'api/visitor-count',
            'api/visitor-details',
        ];

        if (
            in_array($request->ip(), $excludedIps) ||
            in_array($request->path(), $excludedPaths)
        ) {
            return $next($request);
        }

        // 🔹 Ambil lokasi penyimpanan dari konfigurasi
        $filePath = Config::get('visitor-tracker.storage_path', storage_path('app/visitor.json'));

        File::ensureDirectoryExists(dirname($filePath), 0755, true);

        if (!File::exists($filePath)) {
            File::put($filePath, json_encode([]));
        }

        $visitorData = [
            'ip'     => $request->ip(),
            'agent'  => $request->userAgent(),
            'time'   => now()->toDateTimeString(),
        ];

        try {
            $jsonContent = File::get($filePath);
            $existingData = json_decode($jsonContent, true);

            if (!is_array($existingData)) {
                $existingData = [];
            }

            $existingData[] = $visitorData;

            File::put($filePath, json_encode($existingData, JSON_PRETTY_PRINT));
        } catch (\Throwable $e) {
            Log::error("Visitor Tracker Error: ", [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);
        }

        return $next($request);
    }
}
