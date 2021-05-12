<?php

namespace Models;

class Meals extends Database
{
    public function newMeal($name, $image,$alt,$id_category)
    {
    	$this -> modifyOne("
    	INSERT INTO meal (name, src, alt, id_category)
    	VALUES (?, ?, ?, ?)" ,[$name, $image, $alt, $id_category]);
    }
    public function editMeal($name,$image,$alt,$id_category,$id)
    {
    	$this -> modifyOne("
    	UPDATE meal SET name = ?, src = ?, alt = ?, id_category = ?
    	WHERE id = ?" ,[$name,$image,$alt,$id_category,$id]);
    }
    public function deleteMeal($id)
    {
    	$this -> modifyOne("
    	DELETE FROM meal
    	WHERE id = ? ", [$id]);
    }
    public function getMealById($id)
    {
    	return $this -> findOne("
    	SELECT meal.id, meal.name, src, alt, category.name as category
    	FROM meal
    	INNER JOIN category ON meal.id_category = category.id
    	WHERE id = ?", [$id]);
    }
    public function getAllMeals()
    {
        return $this -> findAll("
    	SELECT meal.id, meal.name, src, alt, category.name as category
    	FROM meal
    	INNER JOIN category ON meal.id_category = category.id
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