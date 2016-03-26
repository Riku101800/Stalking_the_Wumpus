<?php

    /**
     * A class that accepts user input and updates the game
     */
    class WumpusController {
        /**
         * @brief Constructor
         * @param Wumpus $wumpus  The Wumpus object
         * @param array $request  The $_REQUEST array
         */
        public function __construct( Wumpus $wumpus, $request ) {
            $this->wumpus = $wumpus;

            // Move request
            if( isset($request['m']) ) {
                $this->move( $request['m'] );
            }

            // Shoot request
            else if( isset($request['s']) ) {
                $this->shoot( $request['s'] );
            }

            // New game request
            else if( isset($request['n']) ) {
                $this->reset = true;
            }
        }


        /**
         * @brief Get the page
         * @return string  The page to redirect to
         */
        public function getPage() {
            return $this->page;
        }

        /**
         * @brief Will the game be reset?
         * @return bool  True, if need to create a new game
         */
        public function isReset() {
            return $this->reset;
        }


        /**
         * @brief Move request
         * @param int $ndx  Index of room to move to
         */
        private function move($ndx) {
            // Simple error check
            if( !is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS ) {
                return;
            }

            switch( $this->wumpus->move($ndx) ) {
                case Wumpus::HAPPY:
                    break;

                case Wumpus::EATEN:
                case Wumpus::FELL:
                    $this->reset = true;
                    $this->page = 'lose.php';
                    break;
            }
        }

        /**
         * @brief Shoot request
         * @param int $ndx  Index of room to shoot into
         */
        private function shoot($ndx) {
            // Simple error check
            if( !is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS ) {
                return;
            }

            else {
                // If you shoot the wumpus, you win
                if( $this->wumpus->shoot($ndx) == Wumpus::WUMPUS ) {
                    $this->reset = true;
                    $this->page = 'win.php';
                }

                // If you run out of arrows, you lose
                else if( $this->wumpus->numArrows() <= 0 ) {
                    $this->reset = true;
                    $this->page = 'lose.php';
                }
            }
        }


        /* Member Variables */
        private $wumpus;              // Wumpus object being controlled
        private $page = 'game.php';   // Next page to go to
        private $reset = false;       // True, if game needs to be reset
    }

?>
