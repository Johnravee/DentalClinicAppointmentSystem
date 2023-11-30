<?php
require_once('../models/queryClass.php');
require_once("../connection/database.php");

$queryMethods = new updateQuries($conn);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    try{
        // IF SET THE name = "userProfileID"
        if(isset($_POST['userProfileID'])){
            $firstName = htmlspecialchars(strtoupper($_POST['firstName']));
            $middleName = htmlspecialchars(strtoupper($_POST['middleName']));
            $surName = htmlspecialchars(strtoupper($_POST['surName']));
            $contact = htmlspecialchars(strtoupper($_POST['contact']));
            $birthDate = htmlspecialchars(strtoupper($_POST['birthDate']));
            $address = htmlspecialchars(strtoupper($_POST['address']));
            $userID = $_POST['userProfileID'];


            //Check if file upload has errors
            if($_FILES['profileImg']['error'] === 0){
                $image = addslashes(file_get_contents($_FILES['profileImg']['tmp_name']));
               $isSuccess = $queryMethods->updateUserProfile($userID, $image, $firstName, $middleName, $surName, $contact, $birthDate, $address);

               if($isSuccess){
                $_SESSION['firstname'] = $firstName;
                $_SESSION['surname'] = $surName;
                header('Location: /CLINICAPPOINTMENTSYS/pages/userProfile.php');
                return;
               }
            }else{   
              $isSuccess = $queryMethods->updateUserProfile($userID, null, $firstName, $middleName, $surName, $contact, $birthDate, $address);
              if($isSuccess){
                $_SESSION['firstname'] = $firstName;
                $_SESSION['surname'] = $surName;
                header('Location: /CLINICAPPOINTMENTSYS/pages/userProfile.php');
                return;
               }
            }

            // IF SET THE name = "adminPofileID"
        }else if(isset($_POST['adminProfileID'])){
            $email = htmlspecialchars($_POST['email']);
            $firstName = htmlspecialchars(strtoupper($_POST['firstName']));
            $middleName = htmlspecialchars(strtoupper($_POST['middleName']));
            $surName = htmlspecialchars(strtoupper($_POST['surName']));
            $contact = htmlspecialchars(strtoupper($_POST['contact']));
            $birthDate = htmlspecialchars(strtoupper($_POST['birthDate']));
            $address = htmlspecialchars(strtoupper($_POST['address']));
            $adminProfileID = $_POST['adminProfileID'];

            if($_FILES['profileImg']['error'] === 0){
                $image = addslashes(file_get_contents($_FILES['profileImg']['tmp_name']));
              $isSuccess = $queryMethods->updateAdminProfile($adminProfileID, $email, $image, $firstName, $middleName, $surName, $contact, $birthDate, $address);
                
              if($isSuccess){
                $_SESSION['firstname'] = $firstName;
                $_SESSION['surname'] = $surName;
                header("Location: /CLINICAPPOINTMENTSYS/pages/adminProfile.php");
                return;
              }

            }else{   
              $isSuccess =  $queryMethods->updateAdminProfile($adminProfileID, $email, null, $firstName, $middleName, $surName, $contact, $birthDate, $address);
              if($isSuccess){
                $_SESSION['firstname'] = $firstName;
                $_SESSION['surname'] = $surName;
                header("Location: /CLINICAPPOINTMENTSYS/pages/adminProfile.php");
                return;
              }
            }
        }

        
    }catch(Exception){
        throw new Exception("FAILED TO INSERT UPDATED VALUES");
      
    }


}


?>