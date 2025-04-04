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

        // 🔹 Cek apakah IP pengunjung ada di daftar yang dikecualikan
        $excludedIps = Config::get('visitor-tracker.excluded_ips', []);
        if (in_array($request->ip(), $excludedIps)) {
            return $next($request);
        }

        // 🔹 Ambil lokasi penyimpanan dari konfigurasi
        $filePath = Config::get('visitor-tracker.storage_path', storage_path('app/visitor.json'));

        // 🔹 Pastikan direktori penyimpanan ada
        File::ensureDirectoryExists(dirname($filePath), 0755, true);

        // 🔹 Cek apakah file sudah ada, jika tidak buat file baru
        if (!File::exists($filePath)) {
            File::put($filePath, json_encode([]));
        }

        // 🔹 Data visitor yang akan dicatat
        $visitorData = [
            'ip'     => $request->ip(),
            'agent'  => $request->userAgent(),
            'time'   => now()->toDateTimeString(),
        ];

        try {
            // 🔹 Ambil data lama dari file
            $jsonContent = File::get($filePath);
            $existingData = json_decode($jsonContent, true);

            // 🔹 Jika parsing gagal, reset ke array kosong
            if (!is_array($existingData)) {
                $existingData = [];
            }

            // 🔹 Tambahkan data baru ke array
            $existingData[] = $visitorData;

            // 🔹 Simpan kembali ke file JSON
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
