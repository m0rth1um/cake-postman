<?php
return [
    'CakePostman' => [
        'collections' => [
            'path' => ROOT . '/app_data/collections/',
            'acceptedFileTypes' => '/\.(postman_collection)$/i',
            'fileNameIdentifer' => 'postman_plugin'
        ],
        'environments' => [
            'path' => ROOT . '/app_data/environments/',
            'acceptedFileTypes' => '/\.(postman_environment)$/i'
        ]
    ]
];
