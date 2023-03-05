<?php

// Connect to the Database 
$servername = "localhost";
$username = "id20398941_idiscussdb";
$password = "D1zgQYv<5ZF61-P&";
$database = "id20398941_idiscuss";


// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

?>