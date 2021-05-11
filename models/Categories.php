<?php

namespace Models;

class Categories extends Database
{
    public function getAllCategories()
    {
        return $this -> findAll("
    	SELECT id, name, is_dish, description
    	FROM category
    	");
    }
    public function getCategoryById($id)
    {
    	return $this -> findOne("
    	SELECT id, name, is_dish, description
    	FROM category
    	WHERE id = ?", [$id]);
    }
    public function updateCategory($datas)
    {
        $this -> modifyOne("
            UPDATE category
            SET name = ?, is_dish = ?, description = ?
            WHERE id = ?", $datas);
    }
    public function delCategory($id)
    {
        if(window.confirm("Etes vous sur de vouloir suppriemr cette catégorie ?")){
            $this -> modifyOne("
                DELETE FROM category
                WHERE id = ?", [$id]);
        }
    }
    public function newCategory($datas)
    {
        $this -> modifyOne("
            INSERT INTO category(name, is_dish, description)
            VALUES (?, ?, ?)", $datas);
    }
    
    
    
}