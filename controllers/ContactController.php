<?php

namespace Controllers;

class ContactController
{
	private $model;
	public $message;
	public function __construct()
	{
		
	}
	public function display()
	{
		$template = "views/contact.phtml";
		include 'views/layout.phtml';
	}
	
}