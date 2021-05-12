<?php

namespace Models;

class Slider extends Database
{
    public function getAllSliderImages():array
    {
        return $this -> findAll("
    	SELECT id, src, alt, published, poids
    	FROM slider
    	");
    }
    public function getImageById($id):array
    {
    	return $this -> findOne("
    	SELECT id, src, alt, published, poids
    	FROM slider
    	WHERE id = ?",[$id]);
    }
    
    public function addSlider($image,$alt,$published,$poids)
    {
    	$this -> modifyOne("
    	INSERT INTO slider (src, alt, published, poids)
    	VALUES (?, ?, ?, ?)" ,[$image,$alt,$published,$poids]);
    	
    }
    
    public function deleteSliderImage($id)
    {
    	$this -> modifyOne("
    	DELETE FROM slider
    	WHERE id = ? ", [$id]);
    	
    }
    
    public function editSlider($image,$alt,$published,$poids,$id)
    {
    	$this -> modifyOne("
    	UPDATE slider 
    	SET src = ?, alt = ?, published = ?, poids = ?
    	WHERE id = ?" ,[$image,$alt,$published,$poids,$id]);
    	
    }
    
    
}