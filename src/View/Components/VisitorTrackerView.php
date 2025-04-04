<?php

namespace XBlade\VisitorTracker\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class VisitorTrackerView extends Component
{
    public $visitors;       // Kunjungan hari ini
    public $totalVisitors;  // Total semua kunjungan

    public function __construct()
    {
        $filePath = config('visitor-tracker.storage_path', storage_path('app/visitor.json'));

        $allVisitors = File::exists($filePath) ? json_decode(File::get($filePath), true) : [];

        $this->totalVisitors = count($allVisitors);

        // Filter hanya kunjungan hari ini
        $today = Carbon::today();
        $this->visitors = collect($allVisitors)->filter(function ($visitor) use ($today) {
            return Carbon::parse($visitor['time'])->isSameDay($today);
        })->values()->all();
    }

    public function render()
    {
        return view('visitor-tracker::visitor', [
            'visitors' => $this->visitors,
            'totalVisitors' => $this->totalVisitors,
        ]);
    }
}
