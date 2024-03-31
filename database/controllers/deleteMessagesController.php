<?php

require_once("../models/queryClass.php");
require_once("../connection/database.php");
$queryMethods = new deleteQueries($conn);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userID = $_POST['userID'];

    $isSuccess = $queryMethods->deleteData("customer_ID", null, $userID, "messages");

    if($isSuccess) header('Location: /DentalClinicAppointmentSystem/pages/userDashboard.php');
}


?>