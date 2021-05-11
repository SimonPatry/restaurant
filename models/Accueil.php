<?php

namespace Models;

class Accueil extends Database
{
    public function accueilDatas()
    {
    	return $this -> findAll("
    	SELECT id, name, content
    	FROM config", []);
    }
}