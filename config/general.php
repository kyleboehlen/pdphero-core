<?php

return [
    'progress_bar' => [
        'low_percentage_cut_off' => env('PROGRESS_BAR_LOW_PERCENTAGE', 15),
    ],
    'exempt_mobile_install_routes' => [
        'about', 'faqs', 'stripe', 'tos', 'privacy', 
	'laravelpwa.', // Offline route
    ],
];
