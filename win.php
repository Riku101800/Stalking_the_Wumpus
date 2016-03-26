<?php
    require 'format.inc.php';
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <meta charset="UTF-8">
    <title>You Killed the Wumpus</title>
</head>

<body>
    <?php
        echo presentHeader( "Stalking the Wumpus" );
    ?>

    <div class="content">
        <p class="imageBlock">
            <img src="dead-wumpus.jpg" width="600" height="325" alt="The dead Wumpus"/>
        </p>

        <p>You killed the Wumpus</p>

        <p><a href="welcome.php">New Game</a></p>
    </div>
</body>
</html>