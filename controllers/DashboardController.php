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
	private $users;
	public function __construct()
	{
		$this -> categories = new \Models\Categories();
		$this -> bookings = new \Models\Booking();
		$this -> users = new \Models\Users();
	}
	
	public function displayCategories()
	{
	    $categoriesTable = $this -> categories -> getAllCategories();
		include "views/dashboard.phtml";
	}
	
	public function displayBooking()
	{
	    $bookingTable = $this -> bookings -> getAllBookings();
	    $usersTable = $this -> users -> getAllUsers();
		include "views/dashboardBooking.phtml";
	}
	
	public function editBooking()
	{
		$datas = file_get_contents('php://input');
		$updateBooking = json_decode($datas);
		$this -> bookings ->updateBooking($updateBooking -> number, $updateBooking -> date, $updateBooking -> hour, $updateBooking -> status, $updateBooking -> comment, $updateBooking -> user, $updateBooking -> id);
	}
	
	public function deleteBooking()
	{
		$id = $_GET['id'];
		$this -> bookings -> deleteBooking($id);
	}
	
	public function addBooking()
	{
		$datas = file_get_contents('php://input');
		$addBooking = json_decode($datas);
		var_dump($addBooking);
		$this -> bookings -> addBooking($addBooking -> number, $addBooking -> date, $addBooking -> hour, $addBooking -> status, $addBooking -> comment, $addBooking -> user);
	}
	
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/layout.phtml';
	}
}