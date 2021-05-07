<?php

namespace Models;

class Menus extends Database
{
    public function getAllMenus()
    {
    	return $this -> findAll("
    	SELECT 
    	FROM 
    	");
    	
    }
}