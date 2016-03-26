<?php
    require 'format.inc.php';
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <meta charset="UTF-8">
    <title>The Wumpus Killed You</title>
</head>

<body>
    <?php
        echo presentHeader( "Stalking the Wumpus" );
    ?>

    <div class="content">
        <p class="imageBlock">
            <img src="wumpus-wins.jpg" width="600" height="325" alt="The Wumpus eating your brain"/>
        </p>

        <p>You died and the Wumpus ate your brain!</p>

        <p><a href="welcome.php">New Game</a></p>
    </div>
</body>
</html>