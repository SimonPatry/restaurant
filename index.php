<?php

spl_autoload_register(function ($class_name) {
	
    if (strchr($class_name, "Models"))
    {
    	$file = substr($class_name, 19);
    	include "models/".$file.".php";
    }
    else
    {
		$file = substr($class_name, 12);
		include "controllers/".$file.".php";
	}
});

session_start();

if (isset($_GET['page']))
{
	
	switch($_GET['page'])
	{
		case 'admin':
		$controller = new Controllers\AdminController();
		$controller -> display();
		break;
	}
	
}
else
{
	$controller = new Controllers\AccueilController();
	$controller -> display();
}
