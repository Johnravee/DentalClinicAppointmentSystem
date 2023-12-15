<?php
session_start();
if(isset($_SESSION['userID'])){
    header("Location: /CLINICAPPOINTMENTSYS/pages/userDashboard.php");
}
else if(isset($_SESSION['adminID'])){
    header("Location: adminDashboard.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/forgotPassword.css?v=<?php echo time() ?>" />


    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <main>
        <section class="EmailInputContainer">
            <div class="emailInput">
                <form method="get">
                    <h2 class="ForgotPassword">Forgot Password</h2>
                    <div class="form-group">
                        <label for="email">Enter Email</label>
                        <input type="email" name="email" id="email" required />
                    </div>

                    <button type="submit" name="emailSubmit">Submit</button>
                </form>
            </div>
        </section>

        <section class="changePassword">
            <div class="passwordInput">
                <form method="post">
                    <h2 class="CreateYourNewPassword">Create New Password</h2>
                    <div class="form-group">
                        <label for="newPass">New password</label>
                        <input type="password" name="newPass" id="newPass" required />

                        <label for="cpass">Confirm password</label>
                        <input type="password" id="cpass" name="confirmNewPass" required />
                    </div>

                    <button type="submit" name="updatePasswordForm">Submit</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>


<?php


require_once('../database/connection/database.php');
require_once('../database/models/queryClass.php');
$queryMethods = new selectQueries($conn);
$updateQueryMethods = new updateQuries($conn);

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['emailSubmit'])){
        $email = $_GET['email'];

    $isSucess = $queryMethods->getEmails($email);

    if($isSucess){
        echo "<script>
            document.querySelector('.EmailInputContainer').style.display = 'none';
            document.querySelector('.changePassword').style.display = 'flex';
        </script>";
    }else{
        echo "
        <script>
            document.querySelector('.EmailInputContainer').style.display = 'flex';
            document.querySelector('.changePassword').style.display = 'none';
        </script>
        ";
    }
    
    return;
    }
}


if($_SERVER['REQUEST_METHOD'] == "POST"){
   if(isset($_POST['updatePasswordForm'])){
     $cpass = $_POST["confirmNewPass"];
    $newPass = $_POST["newPass"];

    if($newPass !== $cpass){
        echo "<script>alert('PASSWORD IS NOT MATCHED!')</script>";
        return;
    }else{
        $encryptedPassword = password_hash($newPass, PASSWORD_DEFAULT);
        $isSuccess = $updateQueryMethods->updatePassword($encryptedPassword);

        if($isSuccess){
            header('Location: \CLINICAPPOINTMENTSYS\pages\userLoginForm.php');
        }
        
    }
   }
}



?>