<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Visitor Log Storage Path
    |--------------------------------------------------------------------------
    |
    | Tentukan di mana file JSON akan disimpan.
    | Secara default, file akan disimpan di `storage/app/visitor.json`.
    | Jika ingin menyimpannya di tempat lain, ubah path-nya di sini.
    |
    */

    'storage_path' => env('VISITOR_TRACKER_STORAGE_PATH', storage_path('app/visitor.json')),

    /*
    |--------------------------------------------------------------------------
    | Enable Visitor Logging
    |--------------------------------------------------------------------------
    |
    | Jika false, middleware tidak akan mencatat visitor.
    |
    */

    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Exclude IPs from Logging
    |--------------------------------------------------------------------------
    |
    | IP yang masuk dalam daftar ini tidak akan dicatat dalam visitor log.
    | Misalnya, kamu ingin mengecualikan localhost (127.0.0.1).
    |
    */

    'excluded_ips' => [
        '127.0.0.1',
    ],

];
