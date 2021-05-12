<?php

namespace Controllers;


class AccueilController
{
	private $config;
	private $menu;
	private $meal;
	public function __construct()
	{
		$this -> config = new \Models\Accueil();
		$this -> menu = new \Models\Menus();
		$this -> meal = new \Models\Meals();
	}
	
	public function display()
	{
		$intro = $this -> config -> accueilDatas();
		$menus = $this -> menu -> getAllMenus();
		$meals = $this -> meal -> getAllMeals();
		$template = "views/accueil.phtml";
		include 'views/layout.phtml';
	}
}