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
	public function __construct()
	{
		
	}
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/layout.phtml';
	}
	
}