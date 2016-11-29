<?php
spl_autoload_register(function($class) {
	$classFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . $class . '.php';
	if (is_file($classFile)) {
		require $classFile;
	}
});