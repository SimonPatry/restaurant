<?php

namespace Models;

class Users extends Database
{
    public function getAllUsers():array
    {
        return $this -> findAll("
    	SELECT password, email, first_name, last_name, phone
    	FROM admin");
    }
    
    public function getUserByEmail(string $email):array
    {
        return $this -> findOne("
    	SELECT password, email, first_name, last_name, phone
    	FROM admin
    	WHERE email = ?", [$email]);
    }
}