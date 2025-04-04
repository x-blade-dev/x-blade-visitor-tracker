<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Visitor Log Storage Path
    |--------------------------------------------------------------------------
    |
    | Specify where the JSON file will be stored.
    | By default, the file will be stored in `storage/app/visitor.json`.
    | If you want to store it elsewhere, change the path here.
    |
    */

    'storage_path' => env('VISITOR_TRACKER_STORAGE_PATH', storage_path('app/visitor.json')),

    /*
    |--------------------------------------------------------------------------
    | Enable Visitor Logging
    |--------------------------------------------------------------------------
    |
    | If set to false, the middleware will not log visitors.
    |
    */

    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Exclude IPs from Logging
    |--------------------------------------------------------------------------
    |
    | IP addresses in this list will not be recorded in the visitor log.
    | For example, you might want to exclude localhost (127.0.0.1).
    |
    */

    'excluded_ips' => [
        '127.0.0.1',
    ],

];