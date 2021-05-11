<?php

spl_autoload_register(function ($class_name) {
    	$file = lcfirst(str_replace('\\', '/', $class_name));
    	include $file.".php";
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
		
		case 'dashboard':
		$controller = new Controllers\DashboardController();
		$controller -> display();
		break;
		
		case 'menus':
		$controller = new Controllers\MenusController();
		$controller -> display();
		break;
		case 'contact':
		$controller = new Controllers\ContactController();
		$controller -> display();
		break;
	}
}
else if (isset($_GET['ajax']))
{
	switch($_GET['ajax'])
	{
		case 'booking':
			$controller = new Controllers\DashboardController();
			$controller -> displayBooking();
			break;
		
		case 'editBooking':
			$controller = new Controllers\DashboardController();
			$controller -> editBooking();
			break;
			
		case 'deleteBooking':
			$controller = new Controllers\DashboardController();
			$controller -> deleteBooking();
			break;
		case 'addBooking':
			$controller = new Controllers\DashboardController();
			$controller -> addBooking();
			break;
	}
}
else
{
	$controller = new Controllers\AccueilController();
	$controller -> display();
}
