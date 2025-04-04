<?php

namespace XBlade\VisitorTracker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use XBlade\VisitorTracker\View\Components\VisitorTrackerView;
use XBlade\VisitorTracker\Http\Middleware\TrackVisitor;

class XBladeVisitorTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register Blade Component
        Blade::component('x-blade-visitor-tracker-views', VisitorTrackerView::class);

        // Load views
        // $this->loadViewsFrom(__DIR__ . '/../resources/views', 'visitor-tracker');

        // 🔹 Load routes & views from the package
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'visitor-tracker');

        // 🔹 Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/visitor-tracker.php' => config_path('visitor-tracker.php'),
        ], 'visitor-tracker-config');

        // 🔹 Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/visitor-tracker'),
        ], 'visitor-tracker-views');

        // 🔹 Publish storage file (ensure directory exists)
        $storagePath = storage_path('app/visitor.json');
        if (!file_exists(dirname($storagePath))) {
            mkdir(dirname($storagePath), 0755, true);
        }
        if (!file_exists($storagePath)) {
            file_put_contents($storagePath, json_encode([]));
        }

        $this->publishes([
            __DIR__ . '/../storage/visitor.json' => $storagePath,
        ], 'visitor-tracker-storage');

        // 🔹 Register middleware automatically
        if ($this->app->bound(Kernel::class)) {
            $this->app->make(Kernel::class)->pushMiddleware(TrackVisitor::class);
        }
    }

    public function register()
    {
        // 🔹 Merge configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/visitor-tracker.php', 'visitor-tracker');
    }
}
