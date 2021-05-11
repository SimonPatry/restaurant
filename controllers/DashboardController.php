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
	private $menus;
	private $bookings;
	public function __construct()
	{
		$this -> menus = new \Models\Menus();
	}
	
	
	
	//pour le dashbord va chercher les éléments 
	public function displayMenus()
	{
	    $menusTable = $this -> menus -> getAllMenus();
		include "views/dashboardMenus.phtml";
	}
	//edit 
	public function editMenus()
	{
		//donnees formulaire 
		//si on clic sur MODIFIER FORMULAIRE
			//alors on récupere les menus selectionner en fnct de son id
			
			if(!empty($_POST))
			{
				
				$id = $_POST['id'];
				$alias = $_POST['alias'];
				$title = $_POST['title'];
				$alt = $_POST['alt'];
				$categories = $_POST['categories'];
				$price = $_POST['price'];
				
				// on recupere le nom de notre image (var_dump)
				$image_name = $_FILES['image']['name'] ;
	
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image']['tmp_name'];
				
				// on donne le nouveau chemin de notre image
				$image = "assets/ressources/images/menus/$image_name";
		
			    //on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image);
				
				//on appel la fonction qui va modifier les menus (UPTADE)
				$this -> menus -> editMenus($title,$alias,$image,$alt,$price,$categories,$id);
	
			}
	
	}
	
	public function addMenu()
	{
			
			if(!empty($_POST))
			{
				
				$id = $_POST['id'];
				$alias = $_POST['alias'];
				$title = $_POST['title'];
				$alt = $_POST['alt'];
				$id_category = $_POST['categories'];
				$price = $_POST['price'];
			
				// on recupere le nom de notre image (var_dump)
				$image_name = $_FILES['image']['name'] ;
	
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image']['tmp_name'];
				
				// on donne le nouveau chemin de notre image
				$image = "assets/ressources/images/menus/$image_name";
		
			    //on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image);
				
				//on appel la fonction qui va modifier les menus (UPTADE)
				$this -> menus -> addMenus($title,$alias,$image,$alt,$price,$id_category);
	
			}
	
	}
	public function getMenuDatas()
	{
		$menu = $this -> menus -> getMenusById($_GET['id']);
	}
	
	
	
	// supprimer les menus
    public function deleteMenus()
    {
        $id = $_GET['id'];
    	$this -> menus -> deleteMenu($id);
    }
		
	public function display()
	{
		$template = "views/dashboard.phtml";
		include 'views/layout.phtml';
	}
}