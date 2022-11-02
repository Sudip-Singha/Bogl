<?php
require 'constants.php';

// connect to the database

$connnection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(mysqli_errno($connnection)){
    die(mysqli_error($connnection));
}