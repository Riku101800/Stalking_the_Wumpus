<?php

    /**
     * A class that contains the underlying functionality of the game
     */
    class Wumpus {
        const NUM_ROOMS = 20;
        const NUM_PITS = 2;
        const NUM_ARROWS = 3;

        // Possible contents of a room
        const WUMPUS = 1;
        const BIRDS = 2;
        const PIT = 3;

        // Move return values
        const HAPPY = 0;   // Moved unharmed
        const EATEN = 1;   // Eaten by the Wumpus
        const FELL = 2;    // Fell into a pit


        /**
         * @brief Constructor
         * @param int $seed  Random number seed
         */
        public function __construct( $seed = null ) {
            if( $seed === null ) {
                $seed = time();
            }

            srand( $seed );

            $this->constructRooms();
            $this->populateRooms();
        }


        /**
         * @brief Was the player carried?
         * @return bool
         */
        public function wasCarried() {
            return $this->carried;
        }

        /**
         * @brief Get the number of arrows
         * @return int
         */
        public function numArrows() {
            return $this->arrows;
        }


        /**
         * @brief Get a reference to a room
         * @param int $r  Room number (starting at 1)
         * @return Room object
         */
        public function getRoom( $r ) {
            return $this->rooms[$r];
        }

        /**
         * @brief Get the current room
         * @return Room  The room the player is in
         */
        public function getCurrent() {
            return $this->current;
        }


        /**
         * @brief Can the player smell the Wumpus?
         * @return bool  True, if the Wumpus is 1 or 2 rooms away
         */
        public function smellWumpus() {
            // Get the current room
            $room = $this->getCurrent();

            // If the Wumpus is 1 or 2 rooms away
            if( $room->contains(self::WUMPUS, 2) ) {
                return true;
            }

            // Otherwise, return false
            else {
                return false;
            }
        }

        /**
         * @brief Can the player feel a draft?
         * @return bool  True, if a pit is in an adjacent room
         */
        public function feelDraft() {
            // Get the current room
            $room = $this->getCurrent();

            // If a pit is in an adjacent room
            if( $room->contains(self::PIT, 1) ) {
                return true;
            }

            // Otherwise, return false
            else {
                return false;
            }
        }

        /**
         * @brief Can the player hear birds?
         * @return bool  True, if birds are in adjacent room
         */
        public function hearBirds() {
            // Get the current room
            $room = $this->getCurrent();

            // If birds are in an adjacent room
            if( $room->contains(self::BIRDS, 1) ) {
                return true;
            }

            // Otherwise, return false
            else {
                return false;
            }
        }


        /**
         * @brief Move to another room
         *
         * Only called when 'carried' is false!
         *
         * @param int $ndx  Index of the room to move to
         * @return const Result of the player's move
         */
        public function move( $ndx ) {
            $this->carried = false;

            // Find and set the room the player is in
            $room = $this->getRoom($ndx);
            $this->current = $room;

            if( $room->contains(self::WUMPUS, 0) ) {
                return self::EATEN;
            }

            else if( $room->contains(self::PIT, 0) ) {
                return self::FELL;
            }

            else if( $room->contains(self::BIRDS, 0) ) {
                $this->carried = true;

                // Immediately switch to moveBirds()
                return $this->moveBirds( rand(1, self::NUM_ROOMS) );
            }

            else {
                return self::HAPPY;
            }
        }

        /**
         * @brief Move to another room
         *
         * Only called when 'carried' is true!
         *
         * @param int $ndx  Index of the room to move to
         * @return const Result of the player's move
         */
        public function moveBirds( $ndx ) {
            // Find and reset the room the player is in
            $room = $this->getRoom($ndx);
            $this->current = $room;

            if( $room->contains(self::WUMPUS, 0) ) {
                return self::EATEN;
            }

            else if( $room->contains(self::PIT, 0) ) {
                return self::FELL;
            }

            else if( $room->contains(self::BIRDS, 0) ) {
                // If the player is carried by birds again
                return $this->moveBirds( rand(1, self::NUM_ROOMS) );
            }

            else {
                return self::HAPPY;
            }
        }

        /**
         * @brief Shoot an arrow into a room
         * @param int $ndx  Index of the room to shoot into
         * @return bool True, if we shot the Wumpus
         */
        public function shoot( $ndx ) {
            // The room that is shot into
            $shotRoom = $this->getRoom($ndx);

            // If shot into room with the Wumpus
            if( $shotRoom->contains(self::WUMPUS, 0) ) {
                $this->arrows --;   // Lose an arrow
                return true;
            }

            // Ricochet into random, adjacent room
            else {
                $shotRoom2 = $shotRoom->getNeighbors()[rand(0, 2)];

                // If shot into adjacent room with the Wumpus
                if( $shotRoom2->contains(self::WUMPUS, 0) ) {
                    $this->arrows --;   // Lose an arrow
                    return true;
                }

                // If the player shoots and misses
                else {
                    $this->arrows --;   // Lose an arrow
                    return false;
                }
            }
        }


        /**
         * @brief Construct the rooms
         */
        private function constructRooms()
        {
            // Construct 20 random room numbers
            $nums = array();
            for( $i = 1; $i <= self::NUM_ROOMS; $i++ ) {
                $nums[] = $i;
            }

            // And shuffle them
            shuffle( $nums );

            // Construct 20 rooms
            for( $i = 1; $i <= self::NUM_ROOMS; $i++ ) {
                $this->rooms[$i] = new Room( $i, $nums[$i-1] );
            }

            // Make the room connections
            $this->connect(1, 2, 5, 6);
            $this->connect(2, 1, 3, 8);
            $this->connect(3, 2, 4, 10);
            $this->connect(4, 3, 5, 12);
            $this->connect(5, 1, 4, 14);
            $this->connect(6, 1, 7, 15);
            $this->connect(7, 6, 8, 16);
            $this->connect(8, 2, 7, 9);
            $this->connect(9, 8, 10, 17);
            $this->connect(10, 3, 9, 11);
            $this->connect(11, 10, 12, 18);
            $this->connect(12, 4, 11, 13);
            $this->connect(13, 12, 14, 19);
            $this->connect(14, 5, 13, 15);
            $this->connect(15, 6, 14, 20);
            $this->connect(16, 7, 17, 20);
            $this->connect(17, 9, 16, 18);
            $this->connect(18, 11, 17, 19);
            $this->connect(19, 13, 18, 20);
            $this->connect(20, 15, 16, 19);
        }

        /**
         * @brief Populate the rooms
         */
        private function populateRooms() {
            // Place the wumpus, birds, and pits
            $this->randomEmptyRoom()->addContent( self::WUMPUS );
            $this->randomEmptyRoom()->addContent( self::BIRDS );

            for( $p = 0; $p < self::NUM_PITS; $p++ ) {
                $this->randomEmptyRoom()->addContent( self::PIT );
            }

            // Place the player
            $this->current = $this->randomEmptyRoom();
            //echo "Player is in ndx " . $this->current->getNdx() . "\n";
        }


        /**
         * @brief Find a random, empty room in the cave
         * @return Room $room  A room that is empty
         */
        private function randomEmptyRoom() {
            while(true) {
                $ndx = rand( 1, count($this->rooms) );
                $room = $this->getRoom($ndx);

                if( $room->isEmpty() ) {
                    return $room;
                }
            }
        }

        /**
         * @brief Connect a room to three other rooms
         * @param int $r   The room to connect (starting at 1)
         * @param int $n1  Room to connect to (starting at 1)
         * @param int $n2  Room to connect to (starting at 1)
         * @param int $n3  Room to connect to (starting at 1)
         */
        private function connect( $r, $n1, $n2, $n3 )
        {
            $room = $this->rooms[$r];

            $room->addNeighbor( $this->rooms[$n1] );
            $room->addNeighbor( $this->rooms[$n2] );
            $room->addNeighbor( $this->rooms[$n3] );
        }


        /* Member Variables */
        private $rooms = array();   // The rooms in the cave system
        private $current = null;    // The room the player is in
        private $carried = false;   // Carried by birds?

        private $arrows = self::NUM_ARROWS;   // Number of arrows remaining
    }

?>
