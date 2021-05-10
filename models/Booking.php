<?php

namespace Models;

class Booking extends Database
{
    public function getAllBookings():array
    {
        return $this -> findAll("
    	SELECT customer_number, id_user, date, hour, status, comment
    	FROM booking");
    }
    
    public function getBookingByUser(int $id):array
    {
        return $this -> findOne("
    	SELECT customer_number, id_user, date, hour, status, comment
    	FROM booking
    	WHERE id_user = ?", [$id]);
    }
}