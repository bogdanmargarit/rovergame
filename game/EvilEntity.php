<?php
namespace Game;

/**
 * Base class for everything that won't allow the rover to pass.
 */
abstract class EvilEntity 
{
	protected $_id;
	protected $_displaySymbol;
	
	protected function __construct($id, $displaySimbol) 
	{
		$this->_id = $id;
		$this->_displaySymbol = $displaySimbol;
	}
	
	public function getId() 
	{
		return $this->_id;
	}
	
	public function setId($id)
	{
		$this->_id = $id;
	}
	
	public function getDisplaySymbol()
	{
		return $this->_displaySymbol;
	}
	
	public function setDisplaySymbol($displaySimbol)
	{
		$this->_displaySymbol = $displaySimbol;
	}
}