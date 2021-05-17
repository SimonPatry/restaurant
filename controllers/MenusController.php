<?php

namespace Controllers;

class MenusController
{
    private $meal;
    private $category;
	public function __construct()
	{
		$this ->meal = new \Models\Meals();
		$this ->category = new \Models\Categories();
	}
	public function display()
	{
	    $meals = $this -> meal -> getAllMeals();
	    $categories = $this -> category -> getAllCategories();
		$template = "views/menus.phtml";
		include 'views/layout.phtml';
	}
}