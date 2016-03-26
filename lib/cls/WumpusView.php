<?php

    /**
     * A class that provides a view of the game
     */
    class WumpusView {
        /**
         * @brief Constructor
         * @param Wumpus $wumpus  The Wumpus game object
         */
        public function __construct( Wumpus $wumpus ) {
            $this->wumpus = $wumpus;
        }


        /**
         * @brief Generate HTML for the number of arrows remaining
         * @return string
         */
        public function presentArrows() {
            $a = $this->wumpus->numArrows();

            return "<p>You have $a arrow(s) remaining.</p>";
        }

        /**
         * @brief Generate HTML for the status
         * @return string
         */
        public function presentStatus() {
            // Get current room
            $room = $this->wumpus->getCurrent();
            $roomString = "<p>You are in room " . $room->getNum() . "</p>";

            // Initialize all messages as blank
            $birdsString = "<li>&nbsp;</li>";
            $draftString = "<li>&nbsp;</li>";
            $wumpusString = "<li>&nbsp;</li>";
            $carriedString = "<li>&nbsp;</li>";

            if( $this->wumpus->hearBirds() ) {
                $birdsString = "<li>You hear birds!</li>";
            }

            if( $this->wumpus->feelDraft() ) {
                $draftString = "<li>You feel a draft!</li>";
            }

            if( $this->wumpus->smellWumpus() ) {
                $wumpusString = "<li>You smell a wumpus!</li>";
            }

            if( $this->wumpus->wasCarried() ) {
                $carriedString = "<li>You were carried by birds to room " .
                                  $room->getNum() . "!</li>";
            }

            // Display the entire status
            return( '<p>' . date("g:ia l, F j, Y") . '</p>' . $roomString .
                    "<ul>" . $birdsString . $draftString . $wumpusString .
                    $carriedString . "</ul>" );
        }

        /**
         * @brief Generate HTML for the links to the rooms
         * @param int $ndx  An index (0 to 2) for the three rooms
         * @return string
         */
        public function presentRoom($ndx) {
            $room = $this->wumpus->getCurrent()->getNeighbors()[$ndx];

            $roomNum = $room->getNum();
            $roomNdx = $room->getNdx();

            $roomUrl = "game-post.php?m=$roomNdx";
            $shootUrl = "game-post.php?s=$roomNdx";

            $html = <<<HTML
            <div class="cave">
                <p>
                    <img class="caves" src="cave2.jpg" width="180" height="135" alt="A room in the cave"/>
                </p>

                <!-- Update URL-->
                <p><a href="$roomUrl">$roomNum</a></p>
                <p><a href="$shootUrl">Shoot Arrow</a></p>
            </div>
HTML;

            return $html;
        }


        /* Member Variable */
        private $wumpus;   // The Wumpus game object
    }

?>
