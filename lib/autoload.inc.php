<?php

    /**
     * @brief Autoload functionality
     * Classes are stored in directory 'lib/cls' with extension '.php'
     */
    spl_autoload_register( function($class_name) {
        $file = __DIR__ . '/cls/' . str_replace( "\\", "/", $class_name ) . '.php';

        // If the file exists, include it
        if( is_file($file) ) {
            include $file;
        }
    });

?>
