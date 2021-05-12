<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
    {
    	header('location:index.php?page=admin');
    	exit;
    }

class DashboardAccueilController 
{
    private $accueil;
	public function __construct()
	{
		$this -> accueil = new \Models\Accueil();
	}
	
	public function displayAccueil()
	{
	    $accueilTable = $this -> accueil -> accueilDatas();
		include "views/dashboardAccueil.phtml";
	}
	
	public function editAccueil()
	{
		//donnees formulaire 
			if(!empty($_POST))
			{
				$id = $_POST['id'];
				$name = $_POST['name'];
				$content = $_POST['text'];
				$alt = $_POST['alt'];

				$image_name = $_FILES['image']['name'] ;

				$tmp_name = $_FILES['image']['tmp_name'];
				
				$image = "assets/ressources/images/$image_name";

				move_uploaded_file($tmp_name, $image);
				
				$this -> accueil -> editAccueil($name,$content,$image,$alt,$id);
	
			}
	
	}
	
	public function addAccueil()
	{
		//donnees formulaire 
			if(!empty($_POST))
			{
				$id = $_POST['id'];
				$name = $_POST['name'];
				$content = $_POST['text'];
				$alt = $_POST['alt'];

				$image_name = $_FILES['image']['name'] ;

				$tmp_name = $_FILES['image']['tmp_name'];
				
				$image = "assets/ressources/images/$image_name";

				move_uploaded_file($tmp_name, $image);
				
				$this -> accueil -> addAccueil($name,$content,$image,$alt);
	
			}
	
	}
	
	// supprimer 
    public function deleteAccueil()
    {
        $id = $_GET['id'];
    	$this -> accueil -> deleteAccueil($id);
    }
    
    public function getAccueilDatas()
	{
		$accueil = $this -> accueil -> getAccueilById($_GET['id']);
	}
}