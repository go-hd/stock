<?php

return [
    'tax' => [
        'rate' => env('STOCK_TAX_RATE', 0.8),
        'rounding' => env('STOCK_TAX_ROUNDING', 'round'),
    ],
];
