<?php
session_start();
// CHECK IF SESSION IS SET 
if(isset($_SESSION['userID'])){
    header("Location: userDashboard.php");
}else if(isset($_SESSION['adminID'])){
    header("Location: adminDashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Navigation Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
}

.box {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.container {
    text-align: center;
}

h1 {
    margin-bottom: 30px;
}

.buttons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

a {
    text-decoration: none;
    padding: 10px 20px;
    margin: 0 10px;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
}

.user-btn {
    background-color: #007bff;
}

.admin-btn {
    background-color: #28a745;
}
</style>

<body>
    <div class="box">
        <div class="container">
            <h1>Welcome! Log in as?</h1>
            <div class="buttons">
                <a href="userLoginForm.php" class="user-btn">User</a>
                <a href="adminLoginForm.php" class="admin-btn">Admin</a>
            </div>
        </div>
    </div>
</body>

</html>