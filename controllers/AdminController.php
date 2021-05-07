<?php

namespace Controllers;

class AdminController
{
	private $model;
	public $message;
	public function __construct()
	{
		$this -> model = new \Models\Admin();
		$this -> message = "";
		if (!empty($_POST))
		{
			$this -> connection();
		}
		if(isset($_GET['action']) && $_GET['action'] == 'deco')
		{
			session_destroy();
			header('location:index.php?page=login');
			exit;
		}
	}
	private function connection()
	{
		$admin = $this -> model -> getAdminByIdentifiant($_POST['identifiant']);
		$pw = $_POST['pw'];
		if (password_verify($pw, $admin['password']))
		{
			$_SESSION['admin'] = $admin['first_name'];
			header('location:index.php?page=dashboard');
			exit;
		}
	}
	public function display()
	{
		$template = "views/admin.phtml";
		include 'views/layout.phtml';
	}
	
}