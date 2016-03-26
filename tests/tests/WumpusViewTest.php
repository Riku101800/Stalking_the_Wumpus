<?php

	/**
 	* @file
 	* @brief Unit tests for class WumpusView
 	* @cond
 	*/
	class WumpusViewTest extends \PHPUnit_Framework_TestCase
	{
		const SEED = 1422668587;

		/**
		 * @brief Test the Constructor
		 */
		public function test_construct() {
			$wumpus = new Wumpus(self::SEED);
			$view = new WumpusView($wumpus);

			$this->assertInstanceOf( 'WumpusView', $view );
		}


		/**
		 * @brief Test presentArrows
		 */
		public function test_presentArrows() {
			$wumpus = new Wumpus(self::SEED);
			$view = new WumpusView($wumpus);

			$arrows = $view->presentArrows();
			$this->assertContains( '<p>You have 3 arrow(s) remaining.</p>', $arrows );
		}

		/**
		 * @brief Test presentStatus
		 */
		public function test_presentStatus() {
			$wumpus = new Wumpus(self::SEED);
			$view = new WumpusView($wumpus);

			$status = $view->presentStatus();
			$this->assertContains('You are in room 11', $status);
			$this->assertContains("smell a wumpus", $status);
			$this->assertNotContains("carried by birds", $status);
			$this->assertNotContains("feel a draft", $status);
			$this->assertNotContains("hear birds", $status);

			$wumpus->move(20);
			$status = $view->presentStatus();
			$this->assertNotContains("smell a wumpus", $status);
			$this->assertNotContains("carried by birds", $status);
			$this->assertContains("feel a draft", $status);
			$this->assertContains("hear birds", $status);

			$wumpus->move(19);
			$status = $view->presentStatus();
			$this->assertContains("carried by birds", $status);
		}

		/**
		 * @brief Test presentRoom
		 */
		public function test_presentRoom() {
			$wumpus = new Wumpus(self::SEED);
			$view = new WumpusView($wumpus);

			$room = $view->presentRoom(0);
			$this->assertContains('?m=3">6', $room);
			$this->assertContains('?s=3">Shoot', $room);

			$room = $view->presentRoom(1);
			$this->assertContains('?m=9">1', $room);
			$this->assertContains('?s=9">Shoot', $room);

			$room = $view->presentRoom(2);
			$this->assertContains('?m=11">5', $room);
			$this->assertContains('?s=11">Shoot', $room);
		}
	}

	/// @endcond
?>
