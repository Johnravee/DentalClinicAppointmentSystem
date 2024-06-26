<?php
session_start();
// CHECK IF SESSION IS SET 
if(isset($_SESSION['userID'])){
    header("Location: /DentalClinicAppointmentSystem/pages/userDashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | Dental CLinic</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/loginForm.css?v=<?php echo time() ?>">
    <!-- JS -->
    <script defer src="../src/javascript/loginForm.js"></script>
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
</head>

<body>
    <main class="main">

        <div class="logo-container">
            <img src="../src/images/logo.png" alt="Logo of Dental Clinic" />
        </div>

        <div class="login-container">
            <a id="back" href="homepage.php"><i class="bi bi-arrow-left-circle"></i></a>


            <form class="form-group" action="../database/controllers/userLoginController.php" method="post">
                <h2>LOG IN</h2>

                <div id="incorrectPasswordModal">
                    <i class="bi bi-x-circle"></i>
                    <span>The email or password is incorrect.</span>
                </div>

                <input id="email" type="email" name="email" placeholder="Email" required />

                <input id="pass" type="password" name="password" placeholder="Password" required />
                <div id="showDiv">
                    <input type="checkbox" id="showPass" />
                    <label for="showPass">Show password</label>
                </div>
                <a id="forgot" href="forgotPassword.php">Forgot password?</a>

                <button type="submit" id="submit">LOGIN</button>

                <p><a href="registrationForm.php">Create an account?</a></p>
            </form>
        </div>



    </main>
</body>

</html>