<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Custom Artisan Command Definitions
|--------------------------------------------------------------------------
|
| This file allows you to register custom console commands that can be 
| executed through Artisan in Laravel. 
| In this case, a command is defined to display an inspirational quote.
|
*/

/**
 * Custom Command: "php artisan inspire"
 *
 * This command will display a random motivational quote each time it runs.
 * 
 * Usage in terminal:
 *   php artisan inspire
 */
Artisan::command('inspire', function () {
    // Displays an inspirational quote in the terminal
    $this->comment(Inspiring::quote());
})->purpose('Displays an inspirational quote in the console.');
