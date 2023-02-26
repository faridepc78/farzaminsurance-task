<?php

use App\Services\Media\ImageFileService;

return [
    'MediaTypeServices' => [
        'image' => [
            'extensions' => [
                'png', 'jpg', 'jpeg'
            ],
            'handler' => ImageFileService::class
        ],
    ]
];
