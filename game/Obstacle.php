<?php
namespace Game;

class Obstacle extends EvilEntity
{
	public function __construct($id, $displaySymbol = '<span style="color: #ff0000;">* </span>') 
	{
		parent::__construct($id, $displaySymbol);
	}
}