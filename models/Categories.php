<?php

namespace Models;

class Categories extends Database
{
    public function getCategoryById($id)
    {
    	return $this -> findOne("
    	SELECT id, name, is_dish, description
    	FROM category
    	WHERE id = ?", [$id]);
    }
    public function getAllCategories()
    {
        return $this -> findAll("
    	SELECT id, name, is_dish, description
    	FROM category
    	");
    }
}