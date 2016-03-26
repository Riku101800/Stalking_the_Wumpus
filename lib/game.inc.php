<?php

    require __DIR__ . "/autoload.inc.php";

    // Start the PHP session system
    session_start();

    // Define the location in $_SESSION where the Wumpus object is saved
    define( "WUMPUS_SESSION", 'wumpus');


    // If cheat mode is activated, create a new Wumpus session with the seed
    if( isset($_REQUEST['c']) ) {
        $_SESSION[WUMPUS_SESSION] = new Wumpus(1422668587);
    }

    // If it doesn't already exist, create a new Wumpus session
    else if( !isset($_SESSION[WUMPUS_SESSION]) ) {
        $_SESSION[WUMPUS_SESSION] = new Wumpus();   // Seed: 1422668587
    }

    // Otherwise, use the existing Wumpus session
    $wumpus = $_SESSION[WUMPUS_SESSION];

?>
