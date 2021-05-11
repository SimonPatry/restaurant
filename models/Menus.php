<?php

namespace Models;

class Menus extends Database
{
    // Afficher tous les menus
    public function getAllMenus():array
    {
    	return $this -> findAll("
    	SELECT
    	menus.id,
    	title,
    	alias,
    	src,
    	alt,
    	price,
    	id_category,
    	category.name
    	FROM menus
    	INNER JOIN category ON menus.id_category = category.id
    	");
    	
    }
    
    // editer les menus
    public function editMenus($title,$alias,$image,$alt,$price,$id_category,$id)
    {
    	$this -> modifyOne("
    	UPDATE menus SET 
    	title = ?,
    	alias = ?,
    	src = ?,
    	alt = ?,
    	price = ?,
    	id_category = ?
    	WHERE id = ?" ,[$title,$alias,$image,$alt,$price,$id_category,$id]);
    	
    }
    
     //Supprimer 1 Menus
    public function deleteMenus($id)
    {
    	$this -> modifyOne("
    	DELETE FROM menus
    	WHERE id = ? ", [$id]);
    	
    }
    
    // Choix menus par id 
    public function getMenusById($id):array
    {
    	return $this -> findOne("
    	SELECT
    	id,
    	title,
    	alias,
    	src,
    	alt,
    	price,
    	id_category
    	FROM menus
    	WHERE id = ?",[$id]);
    }
    
    // Afficher les menus par categories
    public function getMenusByCategory($category):array
    {
    	return $this -> findAll("
    	SELECT 
    	menus.id,
    	title,
    	alias,
    	src,
    	alt,
    	price,
    	id_category,
    	name.category
    	FROM menus
    	INNER JOIN category ON menus.id_category = category.id
    	WHERE id_category = ?", [$category]);
    	
    }
    
    //Afficher 1 Menus
    public function getOneMenus($menu):array
    {
    	return $this -> findOne("
    	SELECT 
    	title,
    	FROM menus
    	WHERE title = ? ", [$menu]);
    	
    }
    
    // Afficher les menus par alias
    public function getMenusByAlias($alias):array
    {
    	return $this -> findAll("
    	SELECT 
    	title,
    	src,
    	alt,
    	price,
    	id_category,
    	alias
    	FROM menus
    	WHERE alias = ? ", [$alias]);
    	
    }
    
}