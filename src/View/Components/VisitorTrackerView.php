<?php

namespace XBlade\VisitorTracker\View\Components;

use Illuminate\View\Component;

class VisitorTracker extends Component
{
    public function render()
    {
        return view('visitor-tracker::visitor');
    }
}
