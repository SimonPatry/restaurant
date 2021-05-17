<?php

namespace Controllers;


class AccueilController
{
	private $config;
	private $menu;
	private $meal;
	private $slider;
	public function __construct()
	{
		$this -> config = new \Models\Accueil();
		$this -> menu = new \Models\Menus();
		$this -> meal = new \Models\Meals();
		$this -> slider = new \Models\Slider();
	}
	
	public function display()
	{
		$intro = $this -> config -> accueilDatas();
		$menus = $this -> menu -> getAllMenus();
		$meals = $this -> meal -> getAllMeals();
		$sliders = $this -> slider -> getAllSliderImages();
		$template = "views/accueil.phtml";
		include 'views/layout.phtml';
	}
}