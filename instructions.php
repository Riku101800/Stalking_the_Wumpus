<?php
    require 'format.inc.php';
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus Instructions</title>
</head>

<body>
    <?php
        echo presentHeader( "Stalking the Wumpus" );
    ?>

    <div class="content">
        <p class="imageBlock">
            <img src="cave-evil-cat.png" width="600" height="327" alt="The Wumpus in a cave"/>
        </p>

        <p class="instructions">In this game you are hunting the evil, killer Wumpus. This is a
            Wumpus. Yes, it looks like a cat, but that's only a disguise he uses on the Internet.
            The Wumpus lives in a cave. The cave has rooms that are interconnected by tunnels.
            Each room connects to three other rooms. The Wumpus is in one of those rooms.
            You are in another room. You move from room to room. If you enter the room with the
            Wumpus, it claws your eyes out, eats your brain, and you die.</p>
        <p class="instructions">The goal of the game is to shoot the Wumpus with a magic arrow
            before it eats you or you otherwise meet your maker in this dangerous cave. But, be
            careful. You only have 3 arrows. When they are gone, you and you brain are defenseless.
            You shoot an arrow into a room. It will bounce on to one other room randomly. If you
            kill the Wumpus, you win!</p>
        <p class="instructions">The cave has bottomless pits and very strong, unladen swallows. If
            you move into a room with a bottomless pit, you fall in and die. If you move into a
            room with the swallows, they pick you up and drop you in some other room. They may drop
            you in a room with a Wumpus or a bottomless pit, which will positively ruin you day.</p>
        <p class="instructions">If you are in a room adjacent to a bottomless pit, you will feel a
            draft. If you are in a room adjacent to the flock of swallows, you will hear birds.
            The Wumpus smells particularly bad, so if you are within two rooms of the Wumpus,
            you will smell him.</p>
        <p class="instructions">The rooms are connected by tunnels. To move to another room,
            click on the image for that room. To shoot an arrow into an adjacent room, click on
            Shoot Arrow below that room.</p>
        <p class="instructions">Have Fun!</p>

        <p><a href="game.php">Return to Game</a></p>
        <p><a href="welcome.php">New Game</a></p>
    </div>
</body>
</html>