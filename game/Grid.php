<?php
namespace Game;

class Grid 
{
	private $_xAxisCellsNumber,
			$_yAxisCellsNumber,
			$_gridArray,
			$_cellsArray;
			
	public function __construct($xAxisCellsNum, $yAxisCellsNum) 
	{
		$this->_xAxisCellsNumber = $xAxisCellsNum;
		$this->_yAxisCellsNumber = $yAxisCellsNum;
		$this->_generateArrayGrid();
	}
	
	private function _generateArrayGrid() 
	{
		$this->_cellsArray = [];
		$this->_gridArray = [];
		for ($xAxis = 0; $xAxis < $this->_xAxisCellsNumber; $xAxis++) {
			for ($yAxis = 0; $yAxis < $this->_yAxisCellsNumber; $yAxis++) {
				$cell = new Cell($xAxis, $yAxis);
				$this->_gridArray[$xAxis][$yAxis] = $cell;
				$this->_cellsArray[] = $cell;
			}
		}
	}
	
	public function getXAxisCellsNumber() 
	{
		return $this->_xAxisCellsNumber;
	}
	
	public function setXAxisCellsNumber($value) 
	{
		$this->_xAxisCellsNumber = $value;
	}
	
	public function getYAxisCellsNumber()
	{
		return $this->_yAxisCellsNumber;
	}
	
	public function setYAxisCellsNumber($value)
	{
		$this->_yAxisCellsNumber = $value;
	}
	
	public function getCellAt($x, $y)
	{
		return $this->_gridArray[$x][$y];
	}
	
	public function setCellAt($x, $y, $value)
	{
		$this->_gridArray[$x][$y]->setObject($value);
	}
	
	public function onNextEmptyCell($object) 
	{
		foreach ($this->_cellsArray as $cell) {
			if ($cell->isEmpty()) {
				$this->setCellAt($cell->getCoordX(), $cell->getCoordY(), $object);
				break;
			}
		}
	}
	
	public function draw()
	{
		for ($i = 0; $i < $this->_xAxisCellsNumber; $i++) {
			for ($k = 0; $k < $this->_yAxisCellsNumber; $k++) {
				
				$cell = $this->getCellAt($k, $i);
				
				if ($cell->isEmpty()) {
					echo '□ ';
				} else {
					$cellObject = $cell->getObject();
					
					if ($cellObject instanceof Rover) {
						echo '<span style="color: pink;">', $cellObject->getDirection(), '</span> ';
					} else if ($cellObject instanceof EvilEntity) { 
						echo $cellObject->getDisplaySymbol();
					} else {
						echo '□ ';
					}
				}
				
			}
			echo '<br />';
		}
		echo '<p>Aliens eaten: ' . $_SESSION['game']['numberOfAliensEaten'] . '</p>';
		echo '<p>Aliens left: ' . count($_SESSION['game']['aliensArray']) . '</p>';
		echo '<p>Current level: ' . $_SESSION['game']['currentLevel'] . '</p>';
	}
}