<?php
// Shorthand for $_SESSION['game'][...]
function gameSession($index)
{
	return $_SESSION['game'][$index];
}

function positionEntitiesOnGrid(array $collection, $grid)
{
	foreach ($collection as $object) {
		if ($grid->getCellAt($object['x'], $object['y'])->isEmpty()) {
			$grid->setCellAt(
				$object['x'],
				$object['y'],
				$object['object']
			);
		} else {
			$grid->onNextEmptyCell($object['object']);
		}
	}
}

function populateSessionWithEntities($arrayName, $counterIndex, $objectType) 
{
	for ($i = 0; $i < gameSession($counterIndex); $i++) {
		$instance = new $objectType($i);
		$_SESSION['game'][$arrayName][$i] = [
			'x' => rand(0, gameSession('gridXSize') - 1),
			'y' => rand(0, gameSession('gridYSize') - 1),
			'object' => $instance
		];
	}
}

function handleRoverOutOfGrid($rover, $grid) 
{
	if ($rover->getCoordX() < 0) {
		$rover->setCoordX($grid->getXAxisCellsNumber() - 1);
	} else if ($rover->getCoordX() > $grid->getXAxisCellsNumber() - 1) {
		$rover->setCoordX(0);
	}
	
	if ($rover->getCoordY() < 0) {
		$rover->setCoordY($grid->getYAxisCellsNumber() - 1);
	} else if ($rover->getCoordY() > $grid->getYAxisCellsNumber() - 1) {
		$rover->setCoordY(0);
	}
}

function handleRoverCollision($rover, $grid)
{
	global $rLastX, $rLastY;
	
	$desiredCell = $grid->getCellAt($rover->getCoordX(), $rover->getCoordY());
	
	if ($desiredCell->isEmpty()) {
		$grid->setCellAt($rover->getCoordX(), $rover->getCoordY(), $rover);
		$grid->setCellAt($rLastX, $rLastY, null);
		$grid->getCellAt($rLastX, $rLastY)->setEmpty(true);
	}  else {		
		$objectInCell = $desiredCell->getObject();
		if ($objectInCell instanceof Game\Alien) {
			$grid->setCellAt($rover->getCoordX(), $rover->getCoordY(), $rover);
			$grid->setCellAt($rLastX, $rLastY, new Game\Cell($rLastX, $rLastY));
		
			$i = 0;
			foreach ($_SESSION['game']['aliensArray'] as $key => &$alien) {
				if ($alien === null) continue;
				if ($alien['object']->getId() == $objectInCell->getId()) {
					unset($_SESSION['game']['aliensArray'][$key]);
				}
				$i++;
			}
			$grid->getCellAt($rLastX, $rLastY)->setEmpty(true);
			echo 'Has comido alien!</br >';
		} else {
			$rover->setCoordX($rLastX);
			$rover->setCoordY($rLastY);
			echo 'Obstacle ahead!<br />';
		}
	}
}

function removeObject($object)
{
	
}