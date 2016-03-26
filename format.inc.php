<?php

    /**
     * Creates the HTML for the header block
     * @param string $title  Title of the page
     * @return string $html  HTML for the header block
     */
    function presentHeader( $title ) {
        $html = <<<HTML
            <header>
                <nav>
                    <ul>
                        <li><a href="welcome.php">New Game</a></li>
                        <li><a href="game.php">Game</a></li>
                        <li><a href="instructions.php">Instructions</a></li>
                    </ul>
                </nav>

                <h1>$title</h1>
            </header>
HTML;

        return $html;
    }
