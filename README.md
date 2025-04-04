# XBlade Visitor Tracker

XBlade Visitor Tracker is a simple Laravel package that logs website visitors and stores their information in a JSON file.

## Features
- Logs visitor IP, User-Agent, and visit time
- Stores logs in a JSON file
- Provides a simple Blade view to display logs
- Configurable via `config/visitor-tracker.php`
- Excludes specific IPs from logging

## Installation

You can install the package via Composer:

```sh
composer require x-blade/x-blade-visitor-tracker
```

### Publish Configuration File
After installation, publish the configuration file:

```sh
php artisan vendor:publish --tag=visitor-tracker-config
```

This will create a `config/visitor-tracker.php` file where you can modify settings.

### Publish Views
To publish the visitor log view:

```sh
php artisan vendor:publish --tag=visitor-tracker-views
```

### View Visitor Logs
You can view visitor logs by accessing:

```
/visitor-log
```

This will display a simple table with all visitor entries.

## Configuration

Modify `config/visitor-tracker.php` as needed:

```php
return [
    'storage_path' => storage_path('app/visitor.json'),
    'enabled' => true,
    'excluded_ips' => [
        '127.0.0.1',
    ],
];
```

- **`storage_path`**: Defines where the JSON log file is stored.
- **`enabled`**: Enables or disables visitor logging.
- **`excluded_ips`**: IP addresses to exclude from tracking.

## License

This package is open-source and licensed under the [MIT License](LICENSE).

---

For more details, visit [x-blade.dev](https://x-blade.dev). 🚀

