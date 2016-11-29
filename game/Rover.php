<?php
namespace Game;

class Rover implements Movable
{
	private $_coordX,
			$_coordY,
			$_direction;
			
	public function __construct($coordX, $coordY, $direction)
	{
		$this->_coordX = $coordX;
		$this->_coordY = $coordY;
		$this->_direction = $direction;
	}
	
	public function getCoordX() 
	{
		return $this->_coordX;
	}
	
	public function setCoordX($coordX)
	{
		$this->_coordX = $coordX;
	}
	
	public function getCoordY()
	{
		return $this->_coordY;
	}
	
	public function setCoordY($coordY)
	{
		$this->_coordY = $coordY;
	}
	
	public function getDirection()
	{
		return $this->_direction;
	}
	
	public function setDirection($direction)
	{
		$this->_direction = $direction;
	}
	
	/** @Override */
	public function move($direction) 
	{
		switch ($direction) {
			case Direction::NORTH: $this->_coordY -= 1;
				break;
			case Direction::SOUTH: $this->_coordY += 1;
				break;
			case Direction::EAST: $this->_coordX += 1; 
				break;
			case Direction::WEST: $this->_coordX -= 1;
				break;
		}
		return true;
	}
	
	/** @Override */
	public function turn($direction)
	{
		$this->_direction = $direction;
	}
}
