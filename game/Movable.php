<?php
namespace Game;

interface Movable 
{
	public function move($direction);
	public function turn($direction);
}
