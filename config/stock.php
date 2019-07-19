<?php

return [
    'tax' => [
        'rate' => env('STOCK_TAX_RATE', 0.08),
        'rounding' => env('STOCK_TAX_ROUNDING', 'round'),
    ],
];
