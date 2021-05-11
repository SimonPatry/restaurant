<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
    {
    	header('location:index.php?page=admin');
    	exit;
    }

class DashboardController
{
	private $accueil;
	public function __construct()
	{
		$this -> accueil = new \Models\Accueil();
	}
	public function displayAccueil()
	{
		$infos = $this -> accueil -> accueilDatas();
		var_dump($infos);
		include 'views/dashboardAccueil.phtml';
	}
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/dashboardLayout.phtml';
	}
}