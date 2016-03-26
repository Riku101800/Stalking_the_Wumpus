<?php

	/**
 	* @file
 	* @brief Unit tests for class Wumpus
 	* @cond
 	*/
	class WumpusTest extends \PHPUnit_Framework_TestCase
	{
		const SEED = 1422668587;

		/**
		 * @brief Test the Constructor
		 */
		public function test_construct() {
			$wumpus = new Wumpus( self::SEED );
			$this->assertInstanceOf( "Wumpus", $wumpus );

			// Ensure there are 20 rooms
			for( $r = 1; $r <= Wumpus::NUM_ROOMS; $r++ ) {
				$this->assertInstanceOf( "Room", $wumpus->getRoom($r) );
			}

			// Ensure the rooms are connected correctly
			$this->connect_test( $wumpus, 1, 5, 2, 6 );
			$this->connect_test( $wumpus, 2, 3, 8, 1 );
			$this->connect_test( $wumpus, 3, 10, 2, 4 );
			$this->connect_test( $wumpus, 4, 12, 3, 5 );
			$this->connect_test( $wumpus, 5, 1, 14, 4 );
			$this->connect_test( $wumpus, 6, 1, 15, 7 );
			$this->connect_test( $wumpus, 7, 6, 16, 8 );
			$this->connect_test( $wumpus, 8, 7, 9, 2 );
			$this->connect_test( $wumpus, 9, 8, 17, 10 );
			$this->connect_test( $wumpus, 10, 9, 11, 3 );
			$this->connect_test( $wumpus, 11, 10, 18, 12 );
			$this->connect_test( $wumpus, 12, 11, 13, 4 );
			$this->connect_test( $wumpus, 13, 12, 19, 14 );
			$this->connect_test( $wumpus, 14, 5, 15, 13 );
			$this->connect_test( $wumpus, 15, 14, 20, 6 );
			$this->connect_test( $wumpus, 16, 7, 20, 17 );
			$this->connect_test( $wumpus, 17, 16, 18, 9 );
			$this->connect_test( $wumpus, 18, 17, 19, 11 );
			$this->connect_test( $wumpus, 19, 13, 18, 20 );
			$this->connect_test( $wumpus, 20, 15, 16, 19 );
		}


		/**
		 * @brief Test move
		 */
		public function test_move() {
			$wumpus = new Wumpus(self::SEED);

			// Move to Wumpus
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(9));
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(8));
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(2));
			$this->assertEquals(Wumpus::EATEN, $wumpus->move(3));
			$this->assertFalse($wumpus->wasCarried());

			// Move to birds = picked up and moved to a pit at ndx 15
			$wumpus = new Wumpus(self::SEED);
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(11));
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(18));
			$this->assertEquals(Wumpus::FELL, $wumpus->move(19));
			$this->assertTrue($wumpus->wasCarried());

			// Move to pit
			$wumpus = new Wumpus(self::SEED);
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(11));
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(12));
			$this->assertEquals(Wumpus::HAPPY, $wumpus->move(4));
			$this->assertEquals(Wumpus::FELL, $wumpus->move(5));
			$this->assertFalse($wumpus->wasCarried());
		}

		/**
		 * @brief Test shoot
		 */
		public function test_shoot() {
			$wumpus = new Wumpus(self::SEED);

			// Single shot right on the money
			$this->assertEquals(3, $wumpus->numArrows());
			$this->assertTrue($wumpus->shoot(3));

			$wumpus = new Wumpus(self::SEED);
			$wumpus->move(8);	// Two rooms away

			$this->assertFalse($wumpus->shoot(2));
			$this->assertEquals(2, $wumpus->numArrows());
			$this->assertTrue($wumpus->shoot(2));
			$this->assertEquals(1, $wumpus->numArrows());
		}


		/**
		 * @brief Test getCurrent
		 */
		public function test_getCurrent() {
			$wumpus = new Wumpus(self::SEED);

			$this->assertEquals(10, $wumpus->getCurrent()->getNdx());

			// Make sure moving after being carried by birds works
			$wumpus->move(11);
			$wumpus->move(18);
			$wumpus->move(19);

			$this->assertEquals(15, $wumpus->getCurrent()->getNdx());
		}

		/**
		 * @brief Test smellWumpus
		 */
		public function test_smellWumpus() {
			$wumpus = new Wumpus(self::SEED);

			// Based on this seed, we are in room 10, wumpus is in room 3
			$this->assertTrue($wumpus->smellWumpus());

			// Move two away, should still smell the wumpus
			$wumpus->move(9);
			$this->assertTrue($wumpus->smellWumpus());

			// Move three away, no longer smell wumpus
			$wumpus->move(17);
			$this->assertFalse($wumpus->smellWumpus());
		}

		/**
		 * @brief Test feelDraft
		 */
		public function test_feelDraft() {
			$wumpus = new Wumpus(self::SEED);

			$this->assertFalse($wumpus->feelDraft());

			$wumpus->move(4);
			$this->assertTrue($wumpus->feelDraft());

			$wumpus->move(6);
			$this->assertTrue($wumpus->feelDraft());
		}

		/**
		 * @brief Test hearBirds
		 */
		public function test_hearBirds() {
			$wumpus = new Wumpus(self::SEED);

			$this->assertFalse($wumpus->hearBirds());

			$wumpus->move(18);
			$this->assertTrue($wumpus->hearBirds());
		}


		/**
		 * @brief Makes tests easier to create
		 * @param Wumpus $wumpus  The wumpus object
		 * @param int $r   The room
		 * @param int $n1  Neighboring room 1
		 * @param int $n2  Neighboring room 2
		 * @param int $n3  Neighboring room 3
		 */
		private function connect_test( Wumpus $wumpus, $r, $n1, $n2, $n3 ) {
			$room = $wumpus->getRoom($r);
			$neighbors = $room->getNeighbors();

			$this->assertEquals(3, count($neighbors));

			$this->assertTrue(in_array($wumpus->getRoom($n1), $neighbors, true));
			$this->assertTrue(in_array($wumpus->getRoom($n2), $neighbors, true));
			$this->assertTrue(in_array($wumpus->getRoom($n3), $neighbors, true));
		}
	}

	/// @endcond
?>
