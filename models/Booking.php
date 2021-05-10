<?php

namespace Models;

class Booking extends Database
{
    public function getAllBookings():array
    {
        return $this -> findAll("
    	SELECT id, customer_number, id_user, date, hour, status, comment
    	FROM booking
    	ORDER BY id DESC");
    }
    
    public function getBookingByUser(int $id):array
    {
        return $this -> findOne("
    	SELECT customer_number, id_user, date, hour, status, comment
    	FROM booking
    	WHERE id_user = ?", [$id]);
    }

    public function updateBooking($number,$date,$hour,$status,$comment,$id)
    {
        
        $this -> modifyOne("
        UPDATE booking
        SET customer_number = ?, date = ?, hour = ?, status = ?, comment = ?
        WHERE id = ?
        ", [$number,$date,$hour,$status,$comment,$id]);
        
    }
    
    public function deleteBooking($id)
    {
        
        $this -> modifyOne("
        DELETE FROM booking
        WHERE id = ?
        ", [$id]);
    }
    
    
    
}