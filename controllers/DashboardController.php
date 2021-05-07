<?php

namespace Controllers;

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