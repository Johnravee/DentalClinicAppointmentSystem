<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | Dental Clinic</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/registrationStyle.css?v=<?php echo time() ?>">
    <!-- JS -->
    <script defer src="../src/javascript/registrationForm.js?v=<?php echo time() ?>"></script>
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

    <main class="main">


        <div class="form-container">
            <form class="form" action="../database/controllers/registrationController.php" method="post">
                <a href="userLoginForm.php"><i class="bi bi-arrow-left-circle"></i></a>
                <h2 class="form-label">Registration</h2>
                <div class="input-group">
                    <input class="input" type="email" name="email" placeholder="Email" required />
                    <input class="input" type="text" name="firstName" placeholder="Firstname" required />
                    <input class="input" type="text" name="middleName" placeholder="Middlename" required />
                    <input class="input" type="text" name="surName" placeholder="Surname" required />
                    <input class="input" type="number" name="contact" placeholder="Contact (09-000-000-000)" required />
                    <label for="gender">Gender</label>
                    <select class="gender" name="gender" id="gender" required>
                        <option value="Male" selected>Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <input class="input" type="text" name="address" placeholder="Address" required />
                    <label for="birthDate">Birthdate</label>
                    <input class="input" id="birthDate" type="date" name="birthDate" />
                    <input class="input" id="empID" type="text" name="employeeID" placeholder="Employee ID No." />


                    <div class="accountType">
                        <h4>ACCOUNT TYPE</h4>
                        <span>
                            <input type="radio" name="accountType" class="Acctype" value="user" checked='checked'
                                required />
                            <label for="user">USER</label>
                        </span>
                        <span>
                            <input type="radio" name="accountType" class="Acctype" value="admin" required />
                            <label for="user">ADMINISTRATOR</label>
                        </span>
                    </div>


                    <input class="input" id="pass" type="password" name="password" placeholder="Password" required />
                    <input class="input" id="cpass" type="password" name="cpass" placeholder="Confirm password"
                        required />
                    <small></small>
                    <button class="btn" type="submit">Sign up</button>
                </div>


            </form>
        </div>

        <div class="logo-container">
            <img src="../src/images/logo.png" alt="Logo of Dental Clinic" />
        </div>
    </main>

</body>

</html>