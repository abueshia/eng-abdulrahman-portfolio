<?php

/**
 * Portfolio Public REST API Routes
 *
 * All routes run under the 'api' and 'ApiSetting' middleware group (no API key required).
 * Full /api/v1/* endpoints will be expanded in Phase 6.
 */

declare(strict_types=1);

use App\Http\Controllers\API\MessageController;
use Illuminate\Support\Facades\Route;

Route::post('/message', [MessageController::class, 'CreateMessage'])
    ->middleware('throttle:5,1')
    ->name('api.message.store');
