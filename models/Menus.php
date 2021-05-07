<?php

namespace Models;

class Admin extends Database
{
    public function getAdminByIdentifiant($email)
    {
    	return $this -> findOne("
    	SELECT password, email, first_name, last_name
    	FROM admin
    	WHERE email = ?", [$email]);
    	
    }
}