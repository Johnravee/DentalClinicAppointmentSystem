<?php
    
    try{

        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "dentalclinicdatabase";

        $conn = new mysqli($host, $user, $password, $db);

        if($conn->connect_error){
            echo "DATABASE CONNECTION ERROR";
            die("". $conn->connect_error);
        }

    }catch(Exception $e){
        echo "DATABASE CONNECTION ERROR!";
    }   
?>