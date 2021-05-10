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
	
	public function editBooking()
	{
		$datas = file_get_contents('php://input');
		$updateBooking = json_decode($datas);
		$this -> bookings ->updateBooking($updateBooking -> number, $updateBooking -> date, $updateBooking -> hour, $updateBooking -> status, $updateBooking -> comment, $updateBooking -> id);
	}
	
	public function deleteBooking()
	{
		$id = $_GET['id'];
		$this -> bookings -> deleteBooking($id);
	}
	
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/layout.phtml';
	}
}