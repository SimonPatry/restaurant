<?php

namespace Controllers;

class MenusController
{
    private $meal;
	public function __construct()
	{
		$this ->meal = new \Models\Meals();
	}
	public function display()
	{
	    $meals = $this -> meal -> getAllMeals();
		$template = "views/menus.phtml";
		include 'views/layout.phtml';
	}
}