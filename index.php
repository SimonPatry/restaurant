<?php

spl_autoload_register(function ($class_name) {
    	$file = lcfirst(str_replace('\\', '/', $class_name));
    	include $file.".php";
});


session_start();

if(isset($_GET['cookie']))
{
	switch($_GET['cookie'])
	{
		case 'all':
		$cookie = new Controllers\CookiesController();
		$cookie -> acceptAllCookies();
		break;
		case 'none':
		$cookie = new Controllers\CookiesController();
		$cookie -> rejectAllCookies();
		break;
		case 'personalized':
		$cookie = new Controllers\CookiesController();
		$cookie -> acceptCookies();
		break;
	}
}
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
else if (isset($_GET['ajax']))
{
	switch($_GET['ajax'])
	{
		case 'booking':
			$controller = new Controllers\BookingController();
			$controller -> displayBooking();
			break;
		
		case 'editBooking':
			$controller = new Controllers\BookingController();
			$controller -> editBooking();
			break;
			
		case 'deleteBooking':
			$controller = new Controllers\BookingController();
			$controller -> deleteBooking();
			break;
		case 'addBooking':
			$controller = new Controllers\BookingController();
			$controller -> addBooking();
			break;
		case 'categories':
			$controller = new Controllers\CategoriesController();
			$controller -> displayCategories();
		break;
		case 'editCategory':
			$controller = new Controllers\CategoriesController();
			$controller -> editCategory();
		break;
		case 'addCategory':
			$controller = new Controllers\CategoriesController();
			$controller -> addCategory();
		break;
		case 'delCategory':
			$controller = new Controllers\CategoriesController();
			$controller -> deleteCategory($_GET['id']);
		break;
	
		
		// Menus
		case 'menus':
			$controller = new Controllers\DashboardMenusController();
			$controller -> displayMenus();
			break;
		case 'editMenus':
			$controller = new Controllers\DashboardMenusController();
			$controller -> editMenus();
			break;
		case 'getMenu':
			$controller = new Controllers\DashboardMenusController();
			$controller -> getMenuDatas();
			break;
		case 'addMenu':
			$controller = new Controllers\DashboardMenusController();
			$controller -> addMenu();
			break;
		case 'deleteMenus':
		$controller = new Controllers\DashboardMenusController();
		$controller -> deleteMenus();
		break;
		
		//Accueil
		case 'accueil':
		$controller = new Controllers\DashboardAccueilController();
		$controller -> displayAccueil();
		break;
		case 'editAccueil':
		$controller = new Controllers\DashboardAccueilController();
		$controller -> editAccueil();
		break;
		case 'getAccueil':
		$controller = new Controllers\DashboardAccueilController();
		$controller -> getAccueilDatas();
		break;
		case 'addAccueil':
		$controller = new Controllers\DashboardAccueilController();
		$controller -> addAccueil();
		break;
		case 'deleteAccueil':
		$controller = new Controllers\DashboardAccueilController();
		$controller -> deleteAccueil();
		break;
		
		//Slider
		case 'sliderImage':
			$controller = new Controllers\SliderController();
			$controller -> getAllPublishedImages();
			break;
		case 'slider':
			$controller = new Controllers\SliderController();
			$controller -> displaySlider();
			break;
		case 'editSlider':
			$controller = new Controllers\SliderController();
			$controller -> editSliderImg();
			break;
		case 'addSliderImg':
			$controller = new Controllers\SliderController();
			$controller -> addSliderImg();
			break;
		case 'deleteSliderImg':
			$controller = new Controllers\SliderController();
			$controller -> deleteSliderImg();
			break;
		//MEALS
		case 'meals':
			$controller = new Controllers\DashboardMeals();
			$controller -> displayMeals();
			break;
		case 'editMeal':
			$controller = new Controllers\DashboardMeals();
			$controller -> editMeal();
			break;
		case 'getMeal':
			$controller = new Controllers\DashboardMeals();
			$controller -> getMealDatas();
			break;
		case 'addMeal':
			$controller = new Controllers\DashboardMeals();
			$controller -> addMeal();
			break;
		case 'delMeal':
			$controller = new Controllers\DashboardMeals();
			$controller -> deleteMeal();
			break;
	}
}

else
{
	$controller = new Controllers\AccueilController();
	$controller -> display();
}