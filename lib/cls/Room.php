<?php

    /**
     * A class that describes a room in the cave system
     */
    class Room {
        /**
         * @brief Constructor
         *
         * Every room has an index into the array in the Wumpus class
         * (between 1 and 20) and an assigned room number (seen by the user)
         *
         * @param int $ndx  Index into the array of rooms
         * @param int $num  Assigned room number
         */
        public function __construct( $ndx, $num ) {
            $this->ndx = $ndx;
            $this->num = $num;
        }


        /**
         * @brief Get the index into the cave system array
         * @return int $ndx  Index value, starting at 0
         */
        public function getNdx() {
            return $this->ndx;
        }

        /**
         * @brief Get the assigned room number
         * @return int $num  Room number
         */
        public function getNum() {
            return $this->num;
        }


        /**
         * @brief Add a neighboring room
         * @param Room $room  Neighboring room to add
         */
        public function addNeighbor( Room $room ) {
            $this->neighbors[] = $room;
        }

        /**
         * @brief Get a room's neighbors
         * @return array  Room's neighbors
         */
        public function getNeighbors() {
            return $this->neighbors;
        }


        /**
         * @brief Add content to this room
         * @param int $c  Content (integer constant)
         */
        public function addContent( $c ) {
            $this->contents[] = $c;
        }

        /**
         * @brief Is this room empty (no contents)?
         * @return bool  True, if empty
         */
        public function isEmpty() {
            if( empty($this->contents) ) {
                return true;
            }

            else {
                return false;
            }
        }

        /**
         * @brief Test if a room contains an item
         * @param int $item  Item we are testing (integer constant)
         * @param int $recurse  How many levels away to test
         * @return bool  True, if room or neighbors contain the item
         */
        public function contains( $item, $recurse = 0 ) {
            // Check the current room
            if( in_array($item, $this->contents) ) {
                return true;
            }

            // Check the room's neighbors
            if( $recurse >= 1 ) {
                for( $i = 0; $i < count($this->getNeighbors()); $i++ ) {
                    if( in_array($item, $this->neighbors[$i]->contents) ) {
                        return true;
                    }
                }
            }

            // Check the neighbors' neighbors
            if( $recurse == 2 ) {
                // $i == the room's neighbor
                for( $i = 0; $i <= 2; $i++ ) {
                    if( count($this->neighbors[$i]->getNeighbors()) > 0 ) {

                        // $j == the neighbor's neighbor
                        for( $j = 0; $j < count($this->neighbors[$i]->getNeighbors()); $j++ ) {
                            if( in_array($item, $this->neighbors[$i]->neighbors[$j]->contents) ) {
                                return true;
                            }
                        }
                    }
                }
            }

            // If the item isn't contained anywhere, return false
            return false;
        }


        /* Member Variables */
        private $ndx;   // The room index in the game
        private $num;   // The assigned room number

        private $neighbors = array();   // The room's neighbors
        private $contents = array();    // The room's contents
    }

?>
