<?php
session_start();
// Set this folder as the root folder
define('ROOT', dirname(__FILE__));
// Set the folder for the classes
define('CLASSES', ROOT . '/classes');
// Set the folder for the controllers
define('CONTROLLERS', ROOT . '/controllers');
// Set the folder for the view
define('VIEWS', ROOT . '/views');
// Set the folder for the database
define('DATABASE', CLASSES . '/database');
// Set the folder for the models
define('MODELS', CLASSES . '/models');
// Set the folder for the mongodb files
define('MONGODB', DATABASE . '/mongodb/mongodb');

// Initialise all classes in the classes folder
foreach (glob(CLASSES . "/*.php") as $filename) {
    include $filename;
}

// Initialise all classes in the classes/database folder
foreach (glob(DATABASE . "/*.php") as $filename) {
    include $filename;
}

// autoload.php @generated by Composer

if (PHP_VERSION_ID < 50600) {
    if (!headers_sent()) {
        header('HTTP/1.1 500 Internal Server Error');
    }
    $err = 'Composer 2.3.0 dropped support for autoloading on PHP <5.6 and you are running '.PHP_VERSION.', please upgrade PHP or use Composer 2.2 LTS via "composer self-update --2.2". Aborting.'.PHP_EOL;
    if (!ini_get('display_errors')) {
        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            fwrite(STDERR, $err);
        } elseif (!headers_sent()) {
            echo $err;
        }
    }
    trigger_error(
        $err,
        E_USER_ERROR
    );
}

require_once DATABASE . '/vendor/composer/autoload_real.php';

// var_dump(ComposerAutoloaderInit2fadad489a042c3b3c11ef6068303db6::getLoader());
// return ComposerAutoloaderInit2fadad489a042c3b3c11ef6068303db6::getLoader();
require_once DATABASE . '/vendor/autoload.php';

try {
    $client = new MongoDB\Client("mongodb+srv://yiuxian02:M4MkDA7CpgV9UdDn@experttraining.0ucsg8s.mongodb.net/?retryWrites=true&w=majority");

    // echo "connection: connected successfully,";
} catch (Exception $e) {
    echo 'Error connecting to MongoDB: ',  $e->getMessage(), "\n";
}

$client = new MongoDB\Client("mongodb+srv://yiuxian02:M4MkDA7CpgV9UdDn@experttraining.0ucsg8s.mongodb.net/?retryWrites=true&w=majority");


return ComposerAutoloaderInit2fadad489a042c3b3c11ef6068303db6::getLoader();