<?php
    require 'format.inc.php';
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <meta charset="UTF-8">
    <title>Welcome to Stalking the Wumpus</title>
</head>

<body>
    <?php
        echo presentHeader( "Stalking the Wumpus" );
    ?>

    <div class="content">
        <p class="imageBlock">
            <img src="cave-evil-cat.png" width="600" height="327" alt="The Wumpus in a cave"/>
        </p>

        <p>Welcome to <span id="stw">Stalking the Wumpus</span></p>

        <p><a href="instructions.php">Instructions</a></p>
        <p><a href="game-post.php?n">Start Game</a></p>
    </div>
</body>
</html>