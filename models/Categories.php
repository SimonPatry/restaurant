<?php

namespace Models;

class Categories extends Database
{
    public function delCategory($id)
    {
        $this -> modifyOne("
            DELETE FROM category
            WHERE id = ?", [$id]);
    }
    public function newCategory($datas)
    {
        $this -> modifyOne("
            INSERT INTO category(name, is_dish, description)
            VALUES (?, ?, ?)", $datas);
    }
    public function updateCategory($datas)
    {
        $this -> modifyOne("
            UPDATE category
            SET name = ?, is_dish = ?, description = ?
            WHERE id = ?", $datas);
    }
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