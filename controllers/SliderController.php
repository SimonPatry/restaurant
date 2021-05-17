<?php

namespace Controllers;

class SliderController extends DashboardController
{
    private $slider;
	public function __construct()
    {
        $this -> slider = new \Models\Slider();
    }
	public function displaySlider()
	{
	    $sliderTable = $this -> slider -> getAllSliderImages();
		include "views/dashboardSlider.phtml";
	}
	
	public function editSliderImg()
	{
		//donnees formulaire 
		//si on clic sur MODIFIER FORMULAIRE
			//alors on récupere les menus selectionner en fnct de son id
			
			if(!empty($_POST))
			{
				$id = $_POST['id'];
				$alt = $_POST['alt'];
				$published = $_POST['published'];
				$poids = $_POST['poids'];
				
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
                    $slider = $this -> slider -> getImageById($id);
                    $image = $slider['src'];
                }
				
				//on appel la fonction qui va modifier les menus (UPDATE)
				$this -> slider -> editSlider($image,$alt,$published,$poids,$id);
	
			}
	
	}
	
	public function addSliderImg()
	{
			
			if(!empty($_POST))
			{
				
				$id = $_POST['id'];
				$alt = $_POST['alt'];
				$published = $_POST['published'];
				$poids = $_POST['poids'];
			
				// on recupere le nom de notre image (var_dump)
				$image_name = $_FILES['image']['name'] ;
	
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image']['tmp_name'];
				
				// on donne le nouveau chemin de notre image
				$image = "assets/ressources/images/$image_name";
		
			    //on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image);
				
				//on appel la fonction qui va modifier les menus (UPTADE)
				$this -> slider -> addSlider($image,$alt,$published,$poids);
	
			}
	
	}
	
	
	
	
	// supprimer les menus
    public function deleteSliderImg()
    {
        $id = $_GET['id'];
    	$this -> slider -> deleteSliderImage($id);
    }
}