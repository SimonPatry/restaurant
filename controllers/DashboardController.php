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
	private $bookings;
	public function __construct()
	{
		$this -> categories = new \Models\Categories();
		$this -> bookings = new \Models\Booking();
	}
	
	public function displayCategories()
	{
	    $categoriesTable = $this -> categories -> getAllCategories();
		include "views/dashboard.phtml";
	}
	
	public function displayBooking()
	{
	    $bookingTable = $this -> bookings -> getAllBookings();
		include "views/dashboardBooking.phtml";
	}
	
	
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/layout.phtml';
	}
}