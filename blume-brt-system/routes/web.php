<?php

use Illuminate\Support\Facades\Route;
use App\Events\BRTUpdated;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('/test-broadcast', function () {
    $testData = [
        'brt_code' => 'TEST123',
        'reserved_amount' => 100,
        'status' => 'active',
    ];

    event(new BRTUpdated($testData));

    return 'Broadcast event triggered!';
});
require __DIR__.'/auth.php';
