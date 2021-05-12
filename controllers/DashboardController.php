<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
    {
    	header('location:index.php?page=admin');
    	exit;
    }

class DashboardController
{


	
	public function __construct()
	{
		
	}

	
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/dashboardLayout.phtml';
	}
}