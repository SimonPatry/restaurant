<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
    {
    	header('location:index.php?page=admin');
    	exit;
    }

class DashboardController
{
	private $model;
	public $message;
	private $categories;
	public function __construct()
	{
		$this -> model = new \Models\Categories();
	}
	
	public function displayCategories()
	{
	    $categoriesTable = $this -> categories -> getAllCategories();
		include "views/dashboard.phtml";
	}
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/layout.phtml';
	}
}