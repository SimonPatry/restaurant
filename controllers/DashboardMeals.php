<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
{
	header('location:index.php?page=admin');
	exit;
}

class DashboardMeals
{
    private $meals;
	public function __construct()
	{
		$this -> meals = new \Models\Meals();
	}
	public function displayMeals()
	{
	    $mealsTable = $this -> meals -> getAllMeals();
		include "views/dashboardMeals.phtml";
	}
	public function editMeal()
	{
			if(!empty($_POST))
			{
				
				$id = $_POST['id'];
				$name = $_POST['name'];
				$alt = $_POST['alt'];
				$id_categories = $_POST['categories'];
				$image_name = $_FILES['image']['name'] ;
				$tmp_name = $_FILES['image']['tmp_name'];
				$image = "assets/ressources/images/meals/$image_name";
				move_uploaded_file($tmp_name, $image);
				$this -> meals -> editMeal($name,$image,$alt,$id_categories,$id);
			}
	}
	
	public function addMeal()
	{
	    var_dump("coucou");
		if(!empty($_POST))
		{
		    var_dump("test");
			$name = $_POST['name'];
			$alt = $_POST['alt'];
			$id_category = $_POST['categories'];
			$image_name = $_FILES['image']['name'] ;
			$tmp_name = $_FILES['image']['tmp_name'];
			$image = "assets/ressources/images/meals/$image_name";
			move_uploaded_file($tmp_name, $image);
			$this -> meals -> newMeal($name,$image,$alt,$id_category);
		}
	}
	
	public function getMealDatas()
	{
		$menu = $this -> meals -> getMealById($_GET['id']);
	}
	
    public function deleteMeal()
    {
        $id = $_GET['id'];
    	$this -> meals -> deleteMeal($id);
    }
    
}