<?php

namespace Models;

class Booking extends Database
{
    public function getAllBookings():array
    {
        return $this -> findAll("
    	SELECT booking.id, customer_number, id_user, date, hour, status, comment, users.first_name, users.last_name
    	FROM booking
    	INNER JOIN users ON id_user = users.id
    	ORDER BY id DESC");
    }
    
    public function getBookingByUser(int $id):array
    {
        return $this -> findOne("
    	SELECT customer_number, id_user, date, hour, status, comment
    	FROM booking
    	WHERE id_user = ?", [$id]);
    }

    public function updateBooking($number,$date,$hour,$status,$comment,$user, $id)
    {
        
        $this -> modifyOne("
        UPDATE booking
        SET customer_number = ?, date = ?, hour = ?, status = ?, comment = ?, id_user = ?
        WHERE id = ?
        ", [$number,$date,$hour,$status,$comment,$user,$id]);
        
    }
    
    public function deleteBooking($id)
    {
        $this -> modifyOne("
        DELETE FROM booking
        WHERE id = ?
        ", [$id]);
    }
    
    public function addBooking($number,$date,$hour,$status,$comment, $idUser)
    {
        $this -> modifyOne("
        INSERT INTO booking (customer_number, date, hour, status, comment, id_user)
        VALUES (?,?,?,?,?,?)
        ", [$number,$date,$hour,$status,$comment, $idUser]);
    }
    
}