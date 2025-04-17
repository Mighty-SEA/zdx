<?php

return [
    'tinymce' => [
        'api_key' => env('TINYMCE_API_KEY', 'doonams59tzrmpaybdcyps6vkqr9swu4v4evhla653aaefpu'),
        'options' => [
            'height' => 500,
            'menubar' => true,
            'plugins' => [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
            ],
            'toolbar' => 'undo redo | styles | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table emoticons | removeformat help',
            'content_style' => 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 16px; line-height: 1.6; }',
            'branding' => false,
            'promotion' => false,
            'language' => 'id',
        ]
    ]
]; 