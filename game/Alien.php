<?php
namespace Game;

class Alien extends EvilEntity
{
	public function __construct($id, $displaySymbol = '<span style="color: #00ff00;">Ѭ </span>') 
	{
		parent::__construct($id, $displaySymbol);
	}
}