<?php
require 'autoload.php';

use Game\Grid as Grid;
use Game\Cell as Cell;
use Game\Rover as Rover;
use Game\Alien as Alien;
use Game\EvilEntity as EvilEntity;
use Game\Obstacle as Obstacle;
use Game\Direction as Direction;
use Game\Stack as Stack;

require 'functions.php';

session_start();

if (!isset($_SESSION['game'])) {
	$_SESSION['game'] = [
		'currentLevel' => 1,
		'gridXSize' => 12,
		'gridYSize' => 12,
		'numberOfObstacles' => 7,
		'obstaclesArray' => [],
		'numberOfAliens' => 8,
		'aliensArray' => [],
		'rover' => [
			'last_x_index' => null,
			'last_y_index' => null
		],
		'numberOfAliensEaten' => 0
	];
}

if (count(gameSession('obstaclesArray')) === 0)
	populateSessionWithEntities('obstaclesArray', 'numberOfObstacles', 'Game\Obstacle');

if (count(gameSession('aliensArray')) === 0) {
	// When no aliens are left, increase level...
	$_SESSION['game']['currentLevel']++;
	populateSessionWithEntities('aliensArray', 'numberOfAliens', 'Game\Alien');
}

/**
 * Initialize the grid where the entities and the rover will face each other.
 * The grid is a 2D array populated with Cell objects. Each cell object 
 * has an X and an Y position on the grid and can hold another object.
 */
$grid = new Grid(gameSession('gridXSize'), gameSession('gridYSize'));

// Position all the entities on the grid.
positionEntitiesOnGrid(gameSession('obstaclesArray'), $grid);
positionEntitiesOnGrid(gameSession('aliensArray'), $grid);

// Create the rover keeping track of the coordinates where it was last seen and the direction it was facing.
$rover = new Rover(
	gameSession('rover')['last_x_index'] !== null ? gameSession('rover')['last_x_index'] : rand(0, gameSession('gridXSize') - 1),
	gameSession('rover')['last_y_index'] !== null ? gameSession('rover')['last_y_index'] : rand(0, gameSession('gridYSize') - 1), 
	Direction::NORTH
);

// Add the rover to the grid.
$grid->setCellAt($rover->getCoordX(), $rover->getCoordY(), $rover);

// Keyboard controls accessed by Javascript.
if (isset($_GET['action']) && isset($_GET['direction'])) {
	
	$direction = null;
	switch ($_GET['direction']) {
		case 'north': 
			$direction = Direction::NORTH; 
			break;
		case 'south': 
			$direction = Direction::SOUTH; 
			break;
		case 'east': 
			$direction = Direction::EAST; 
			break;
		case 'west': 
			$direction = Direction::WEST; 
			break;
	}
}

$rLastX = $rover->getCoordX();
$rLastY = $rover->getCoordY();

if ($rover->move($direction, $grid)) {	
	$rover->turn($direction);
	handleRoverOutOfGrid($rover, $grid);
	handleRoverCollision($rover, $grid);
}

// Update rover's last position.
$_SESSION['game']['rover']['last_x_index'] = $rover->getCoordX();
$_SESSION['game']['rover']['last_y_index'] = $rover->getCoordY();

// ...aaaaand draw everything on the screen.
$grid->draw();
?>