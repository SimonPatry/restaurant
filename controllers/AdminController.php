<?php

namespace Controllers;

class AdminController
{
	private $model;
	public $message;
	public function __construct()
	{
		$this -> model = new Models\Admin();
		$this -> message = "";
	}
	public function connection()
	{
		$admin = $this -> model -> getAdminByIdentifiant($_POST('identifiant'));
		$pw = $_POST['pw'];
		if (password_verify(pw, $admin['password']))
		{
			$_SESSION['admin'] = $admin['name'];
		}
	}
	public function display()
	{
		if (!empty($_POST))
		{
			var_dump($_POST);
			$this -> connection();
		}
		$template = "views/admin.phtml";
		include 'views/layout.phtml';
	}
	
}