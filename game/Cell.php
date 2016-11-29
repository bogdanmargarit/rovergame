<?php
namespace Game;

// Simple representation of a cell that has a value.
class Cell
{
	private $_empty,
			$_coordX,
			$_coordY;
			
	private $_object;
	
	public function __construct($coordX, $coordY)
	{
		$this->_coordX = $coordX;
		$this->_coordY = $coordY;
		$this->_empty = true;
		$this->_object = null;
	}
	
	public function getCoordX() 
	{
		return $this->_coordX;
	}
	
	public function getCoordY()
	{
		return $this->_coordY;
	}
	
	public function isEmpty()
	{
		return $this->_empty;
	}
	
	public function setEmpty($empty)
	{
		$this->_empty = $empty;
	}
	
	public function getObject() 
	{
		return $this->_object;
	}
	
	public function setObject($object)
	{
		$this->_object = $object;
		$this->setEmpty(false);
	}
}