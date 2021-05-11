<?php

namespace Controllers;

class CategoriesController
{
    private $categories;
    public function __construct()
    {
        $this -> categories = new \Models\Categories();
    }
	public function displayCategories()
	{
	    $categoriesTable = $this -> categories -> getAllCategories();
		include "views/dashboardCategories.phtml";
	}
	public function editCategory()
	{
		$datas = file_get_contents('php://input');
        
        $cat = json_decode($datas);
        
        $datas = [$cat->name, $cat->is_dish, $cat->description, $cat->id];
	    $this -> categories -> updateCategory($datas);
		include "views/dashboardCategories.phtml";
	}
	public function deleteCategory($id)
	{
	    $this -> categories -> delCategory($id);
		include "views/dashboardCategories.phtml";
	}
	public function addCategory()
	{
		$datas = file_get_contents('php://input');
        
        $cat = json_decode($datas);
        $datas = [$cat->name, $cat->is_dish, $cat->description];
	    $this -> categories -> newCategory($datas);
		include "views/dashboardCategories.phtml";
	}
}