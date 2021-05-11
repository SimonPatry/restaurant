<?php

spl_autoload_register(function ($class_name) {
    	$file = lcfirst(str_replace('\\', '/', $class_name));
    	include $file.".php";
});

session_start();

if (isset($_GET['page']) && !isset($_GET['ajax']))
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
// Pour afficher les pages en AJAX
else if (isset($_GET['ajax']))
{
	switch($_GET['ajax'])
	{
		case 'menus':
		$controller = new Controllers\DashboardController();
		$controller -> displayMenus();
		break;
		case 'editMenus':
		$controller = new Controllers\DashboardController();
		$controller -> editMenus();
		break;
		case 'getMenu':
		$controller = new Controllers\DashboardController();
		$controller -> getMenuDatas();
		break;
		case 'addMenu':
		$controller = new Controllers\DashboardController();
		$controller -> addMenu();
		break;
		case 'deleteMenus':
		$controller = new Controllers\DashboardController();
		$controller -> deleteMenus();
		break;
	}
}
else
{
	$controller = new Controllers\AccueilController();
	$controller -> display();
}
