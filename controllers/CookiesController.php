<?php

namespace Controllers;

class CookiesController
{
    function acceptAllCookies()
    {
        setcookie('params',"all", time() + 3600* 24 * 365);
        
    }
    
    
    function rejectAllCookies()
    {
        setcookie('params',"none", time() + 3600* 24 * 365);
        
    }
    
    function acceptCookies()
    {
        $datas = file_get_contents('php://input');

        //decoder le json
        $cookies = json_decode($datas);
        
        $str = "personalized ";
        $str.= $cookies -> fonctionnel." ";
        $str.= $cookies -> pub." ";
        $str.= $cookies -> suivis;
        
    
        setcookie('params',$str, time() + 3600* 24 * 365);
    }

}