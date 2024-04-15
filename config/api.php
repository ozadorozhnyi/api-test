<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Application Seeder Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify seeder options.
    |
    */

  'seeder' => [
    'users' => [
      'count' => 10_000,
      'chunk' => 1000,
    ],
    'images' => [
      'count' => 100_000,
      'range' => [
        'min' => 1,
        'max' => 50,
      ]
    ],
  ],

];