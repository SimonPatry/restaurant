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
    private $categories;
	public function __construct()
	{
		$this -> meals = new \Models\Meals();
		$this -> categories = new \Models\Categories();
	}
	public function displayMeals()
	{
		if (isset($_GET['id']))
		{
			$editMeal = $this -> meals ->getMealById($_GET['id']);
		}
	    $mealsTable = $this -> meals -> getAllMeals();
	    $categories = $this -> categories -> getAllCategories();
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
				if (!empty($_FILES['img']['name']))
                {
                    // on recupere le nom de notre image (var_dump)
    				$image_name = $_FILES['image']['name'] ;
    				// on recupere tmp de notre image qui est son chemin provisoire
    				$tmp_name = $_FILES['image']['tmp_name'];
    				// on donne le nouveau chemin de notre image
    				$image = "assets/ressources/images/menus/$image_name";
    			    //on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
    				move_uploaded_file($tmp_name, $image);
                }
                else
                {
                	$meal = $this -> meals -> getMealById($id);
                    $image = $meal['src'];
                }
				$this -> meals -> editMeal($name,$image,$alt,$id_categories,$id);
			}
	}
	
	public function addMeal()
	{
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
		$meal = $this -> meals -> getMealById($_GET['id']);
	}
	
    public function deleteMeal()
    {
        $id = $_GET['id'];
        var_dump($id);
    	$this -> meals -> deleteMeal($id);
    }
    
}