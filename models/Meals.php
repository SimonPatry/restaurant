<?php

namespace Models;

class Meals extends Database
{
    public function getMealById($id)
    {
    	return $this -> findOne("
    	SELECT id, name, is_dish, description
    	FROM meal
    	WHERE id = ?", [$id]);
    }
    public function getAllMeals()
    {
        return $this -> findAll("
    	SELECT id, name, is_dish, description
    	FROM meal
    	");
    }
    public function getMealsByCategory($id)
    {
        return $this -> findAll("
    	SELECT id, name, src, alt, id_category
    	FROM meal
    	WHERE id_category = ?", [$id]);
    }
}