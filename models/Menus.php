<?php

namespace Models;

class Menus extends Database
{
    // Afficher tous les menus
    public function getAllMenus()
    {
    	return $this -> findAll("
    	SELECT 
    	title,
    	src,
    	alt,
    	price,
    	id_category
    	FROM menus
    	");
    	
    }
    
    // Afficher les menus par categories
    public function getMenusByCategory($category)
    {
    	return $this -> findAll("
    	SELECT 
    	title,
    	src,
    	alt,
    	price,
    	id_category
    	FROM menus
    	WHERE id_category = ?", [$category]);
    	
    }
    
    //Afficher 1 Menus
    public function getOneMenus($menu)
    {
    	return $this -> findOne("
    	SELECT 
    	title,
    	FROM menus
    	WHERE title = ? ", [$menu]);
    	
    }
    
}