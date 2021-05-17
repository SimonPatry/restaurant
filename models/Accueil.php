<?php

namespace Models;

class Accueil extends Database
{
    // Afficher tout le contenu de la page d'accueil
    public function accueilDatas()
    {
    	return $this -> findAll("
    	SELECT id, 
    	name,
    	SUBSTR(content,1,200) as content,
    	src,
    	alt
    	FROM config");
    }
    
    //Ajouter à la page d'accueil
    public function addAccueil($name,$content,$src,$alt)
    {
        $this -> modifyOne("
        INSERT INTO config(name, content, src, alt)
        VALUES (?, ?, ?, ?)", [$name,$content,$src,$alt]);
    }
    
    //Editer la page d'accueil
    public function editAccueil($name,$content,$image,$alt,$id)
    {
        $this -> modifyOne("
        UPDATE config SET
        name = ?,
        content = ?,
        src =?,
        alt =?
        WHERE id =?" ,[$name,$content,$image,$alt,$id]);
    }
    
    //Supprimer un élément de la page d'accueil
    public function deleteAccueil($id)
    {
        $this -> modifyOne("
        DELETE FROM config
    	WHERE id = ? ", [$id]);
    }
    
    //Choix par id
    public function getAccueilById($id):array
    {
    	return $this -> findOne("
    	SELECT
    	id,name,content,src,alt
    	FROM config
    	WHERE id = ?",[$id]);
    }
}