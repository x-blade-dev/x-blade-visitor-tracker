<?php

namespace XBlade\VisitorTracker\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\File;

class VisitorTrackerView extends Component
{
    public $visitors;

    public function __construct()
    {
        $filePath = config('visitor-tracker.storage_path', storage_path('app/visitor.json'));
        $this->visitors = File::exists($filePath) ? json_decode(File::get($filePath), true) : [];
    }

    public function render()
    {
        return view('visitor-tracker::visitor', ['visitors' => $this->visitors]);
    }
}
