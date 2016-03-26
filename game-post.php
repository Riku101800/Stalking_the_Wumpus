<?php

    require 'lib/game.inc.php';

    $controller = new WumpusController( $wumpus, $_REQUEST );

    // If 'reset' is true, destroy the existing session variable
    if( $controller->isReset() ) {
        unset( $_SESSION[WUMPUS_SESSION] );
    }

    // Redirect to the next page
    header( 'Location: ' . $controller->getPage() );

    //phpinfo();

?>
