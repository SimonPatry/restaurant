<?php

namespace Models;

class Admin extends Database
{
    public function getAdminByIdentifiant($email)
    {
        
    	$result = $this -> findOne("
    	SELECT password, email, first_name, last_name
    	FROM admin
    	WHERE email = ?", [$email]);
    	
        if(!$result)
		{
			throw new \Exception('Cet identifiant n\'existe pas');
		}
		return $result;
    }
}