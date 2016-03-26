<?php
    require 'format.inc.php';
    require 'lib/game.inc.php';
    $view = new WumpusView( $wumpus );
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus</title>
</head>

<body>
    <?php
        echo presentHeader( "Stalking the Wumpus" );
    ?>

    <div class="content">
        <p class="imageBlock">
            <img src="cave.jpg" width="600" height="325" alt="A cave"/>
        </p>

        <!-- Display the status -->
        <?php
            echo $view->presentStatus();
        ?>

        <!-- Display the 3 adjacent caves -->
        <div class="caves">
            <?php
                echo $view->presentRoom(0);
                echo $view->presentRoom(1);
                echo $view->presentRoom(2);
            ?>
        </div>

        <!-- Display the number of arrows remaining -->
        <?php
            echo $view->presentArrows();
        ?>
    </div>
</body>
</html>