<?php

	/**
 	* @file
 	* @brief Unit tests for class WumpusController
 	* @cond
 	*/
	class WumpusControllerTest extends \PHPUnit_Framework_TestCase
	{
		const SEED = 1422668587;

		/**
		 * @brief Test the Constructor
		 */
		public function test_construct() {
			$wumpus = new Wumpus(self::SEED);
			$controller = new WumpusController($wumpus, array());

			$this->assertInstanceOf( 'WumpusController', $controller );
			$this->assertFalse( $controller->isReset() );
			$this->assertEquals( 'game.php', $controller->getPage() );
		}


		/**
		 * @brief Test creating a new game
		 */
		public function test_new() {
			$wumpus = new Wumpus(self::SEED);
			$controller = new WumpusController($wumpus, array('n' => ''));

			$this->assertInstanceOf('WumpusController', $controller);
			$this->assertTrue($controller->isReset());
			$this->assertEquals('game.php', $controller->getPage());
		}

		/**
		 * @brief Test move
		 */
		public function test_move() {
			$wumpus = new Wumpus(self::SEED);
			$controller = new WumpusController($wumpus, array('m' => '11'));

			$this->assertFalse($controller->isReset());
			$this->assertEquals('game.php', $controller->getPage());

			$this->assertEquals(11, $wumpus->getCurrent()->getNdx());
		}

		/**
		 * @brief Test shoot
		 */
		public function test_shoot() {
			$wumpus = new Wumpus(self::SEED);
			$controller = new WumpusController($wumpus, array('s' => '3'));

			$this->assertTrue($controller->isReset());
			$this->assertEquals('win.php', $controller->getPage());
		}
	}

	/// @endcond
?>
