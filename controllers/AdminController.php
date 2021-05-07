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
	}
	private function connection()
	{
		$admin = $this -> model -> getAdminByIdentifiant($_POST['identifiant']);
		$pw = $_POST['pw'];
		if (password_verify($pw, $admin['password']))
		{
			$_SESSION['admin'] = $admin['first_name'];
		}
	}
	public function display()
	{
		$template = "views/admin.phtml";
		include 'views/layout.phtml';
	}
	
}