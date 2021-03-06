<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
    {
    	header('location:index.php?page=admin');
    	exit;
    }

class DashboardMenusController 
{
    private $menus;
    private $menusTable;
    private $categories;
	public function __construct()
	{
		$this -> menus = new \Models\Menus();
		$this -> categories = new \Models\Categories();
	}
	
	
	
	//pour le dashbord va chercher les éléments 
	public function displayMenus()
	{
		if(isset($_GET['id']))
		{
			$editMenu = $this -> menus -> getMenusById($_GET['id']);
		}
	    $menusTable = $this -> menus -> getAllMenus();
	    $categories = $this -> categories -> getAllCategories();
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
                	$menus = $this -> menus -> getImageById($id);
                	$image = $menus['src'];
                }
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
		$menus = $this -> menus -> getMenusById($_GET['id']);
	}
	
	
	
	// supprimer les menus
    public function deleteMenus()
    {
        $id = $_GET['id'];
    	$this -> menus -> deleteMenu($id);
    }
    
}