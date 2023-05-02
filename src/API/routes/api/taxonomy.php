<?php

use Dply\API\Http\Controllers\TaxonomyController;

Route::group(
    [
        'prefix' => 'taxonomy/{type}/{taxonomy}',
    ],
    function () {
        Route::get('/', [TaxonomyController::class, 'index']);
        Route::get('/{slug}', [TaxonomyController::class, 'show']);
    }
);
