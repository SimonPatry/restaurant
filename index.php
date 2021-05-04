<?php

//autoloader
include "controllers/AccueilController.php";

include 'models/Database.php';
include "models/Jeux.php";


$controller = new Controllers\AccueilController();
$controller -> display();