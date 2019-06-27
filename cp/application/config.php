<?php

return array(
    'sitename' => '',
    'db' => include 'config.db.php',
    'layout' => 'base',
    'path_error_controller' => '/cp/error',
    'router' => array(
        '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)/([a-z0-9+/_\-]+)' => '$controller/$action/$id',
        '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)' => '$controller/$action',
        '([a-z0-9+_\-]+)' => '$controller',
    ),
);
