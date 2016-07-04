<?php

// Load config
try {
    $config = parse_ini_file(__DIR__ . '/config.ini', true);
    if (is_array($config)) {
        define('BONITA_SERVER_URL', "{$config['server']['protocol']}://{$config['server']['host']}:{$config['server']['port']}/{$config['server']['bonita_dir']}/");
        define('BONITA_API_URL', BONITA_SERVER_URL . "{$config['server']['api_dir']}/");
        define('BONITA_USERNAME', $config['user']['username']);
        define('BONITA_PASSWORD', $config['user']['password']);
        
        // Includes the necessary files to load the library
        includeFiles(__DIR__ . '/service/');
        includeFiles(__DIR__ . '/api/');        
    }
    
} catch (Exception $e) {
    die($e->getMessage());
}



function includeFiles($path) {
    $dirsIterator = new RecursiveTreeIterator(new RecursiveDirectoryIterator($path));
    $dirs = array();

    foreach ($dirsIterator as $dir => $dirTree) {
        if (is_dir($dir)) {
            $dirs[] = $dir;
        }
    }

    foreach ($dirs as $dir) {
        if (substr_count($dir, '..') > 0) {
            continue;
        }

        $directory = dir($dir);
        while ($file = $directory->read()) {
            if (substr($file, -3) == 'php') {
                require_once $dir . '/' . $file;
            }
        }
    }
}
