<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging in..</title>
    <link rel="shortcut icon" href="/DentalClinicAppointmentSystem/src/images/logo.png" type="image/x-icon">
</head>

<style>
.loader {
    position: absolute;
    content: '';
    top: calc(50% - 2.5rem);
    left: calc(50% - 2.5rem);
    width: 5rem;
    height: 5rem;
    border: 5px solid lightBlue;
    border-radius: 50%;
    overflow: hidden;
    transition: 0.3s;
    box-shadow: 0rem 0rem 0.6rem rgba(0, 0, 0, 0.3);
    animation: spin 1s linear infinite;
}

.success {
    background: lightGreen;
    border-color: lightGreen;
}

.fail {
    background: #ffcccb;
    border-color: #ffcccb;
}

.loader.success {
    &::before {
        height: 7px;
        width: 2.5rem;
        position: absolute;
        top: 65%;
        left: 44%;
        background-color: green;
        transform: rotate(-45deg);
        transform-origin: 0% 50%;
        border-radius: 5px;
        animation: baseGrow 1s;
        content: '';
    }

    &::after {
        height: 7px;
        width: 1.5rem;
        position: absolute;
        top: 65%;
        left: 50%;
        background-color: green;
        transform: rotate(-135deg);
        transform-origin: 0% 50%;
        border-radius: 5px;
        animation: tipGrow 1s;
        content: '';
    }
}

.loader.fail {
    &::before {
        width: 3rem;
        height: 0.5rem;
        background: darkRed;
        transform-origin: 50% 50%;
        top: calc(50% - 0.25rem);
        left: calc(50% - 1.5rem);
        transform: rotate(45deg);
        position: absolute;
        content: '';
        border-radius: 10px;
        animation: leftIn 0.3s linear;
        content: '';
    }

    &::after {
        width: 3rem;
        height: 0.5rem;
        background: darkRed;
        transform-origin: 50% 50%;
        top: calc(50% - 0.25rem);
        right: calc(50% - 1.5rem);
        transform: rotate(-45deg);
        position: absolute;
        content: '';
        border-radius: 10px;
        animation: rightIn 0.3s linear;
        content: '';
    }
}

.loader.success,
.loader.fail {
    animation: pop 1.2s ease-in-out;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
        border-top: 5px solid blue;
    }

    100% {
        transform: rotate(360deg);
        border-top: 5px solid blue;

    }
}

@keyframes tipGrow {
    0% {
        width: 0px;
        left: 0;
        top: 0;
    }

    25% {
        width: 0px;
        left: 0;
        top: 0;
    }

    50% {
        top: 0%;
        left: 0%;
        width: 0;
    }

    75% {
        top: 0%;
        left: 0%;
        width: 0rem;
    }

    100% {
        top: 65%;
        left: 50%;
        width: 1.5rem;
    }
}

@keyframes baseGrow {
    0% {

        width: 0;
    }

    90% {
        width: 0;
    }

    100% {

        width: 2.5rem;
    }
}

@keyframes pop {
    0% {
        transform: scale(1);
    }

    80% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.1);
    }
}

@keyframes leftIn {
    0% {
        left: 0;
        top: 0;
        width: 0;
    }

    100% {
        top: calc(50% - 0.25rem);
        left: calc(50% - 1.5rem);
        width: 3rem;
    }
}

@keyframes rightIn {
    0% {
        rigth: 0;
        top: 0;
        width: 0;
    }

    100% {
        top: calc(50% - 0.25rem);
        right: calc(50% - 1.5rem);
        width: 3rem;
    }
}
</style>

<body>
    <span class="loader">
    </span>
</body>

</html>

<?php
require_once('../models/queryClass.php');
require_once("../connection/database.php");

$queryMethods = new selectQueries($conn);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    try{
        $employeeID = htmlspecialchars($_POST['employeeID']);
        $password = htmlspecialchars($_POST['password']);


        $isSuccess=  $queryMethods->adminLogin($employeeID, $password);
            
            if($isSuccess){
                  echo
            "<script>
               const loader = document.querySelector('.loader');
                    loader.classList.add('success');
                    window.location.href = '/DentalClinicAppointmentSystem/pages/adminDashboard.php';
            </script>";
            }else{
                 echo
            "<script>
               const loader = document.querySelector('.loader');
                    loader.classList.add('fail');
                    window.location.href = '/DentalClinicAppointmentSystem/pages/adminLoginForm.php';
            </script>";
            }
    }catch(Exception $e){
        throw new Exception("Failed to pass the arguments");
    }
}

?>