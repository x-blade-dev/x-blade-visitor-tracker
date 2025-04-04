<?php

namespace XBlade\VisitorTracker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use XBlade\VisitorTracker\View\Components\VisitorTrackerView; // Pastikan class ini sesuai
use XBlade\VisitorTracker\Http\Middleware\TrackVisitor;

class XBladeVisitorTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 🔹 Register Blade Component
        Blade::component('blade-visitor-tracker-views', VisitorTrackerView::class);

        // 🔹 Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'visitor-tracker');

        // 🔹 Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/visitor-tracker.php' => config_path('visitor-tracker.php'),
        ], 'visitor-tracker-config');

        // 🔹 Publish views for customization
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/visitor-tracker'),
        ], 'visitor-tracker-views');

        // 🔹 Ensure storage file exists
        $this->ensureStorageFileExists();

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

    protected function ensureStorageFileExists()
    {
        $storagePath = storage_path('app/visitor.json');

        if (!file_exists($storagePath)) {
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }
            file_put_contents($storagePath, json_encode([]));
        }
    }
}
