<?php

require_once("../database/models/queryClass.php");
require_once('../database/connection/database.php');
$queryMethods = new selectQueries($conn);
$userID = $_SESSION['userID'];
    // CHECK IF SESSION IS SET 
    //Prevent redirecting to this page for those who didn't logged in
    if(!isset($_SESSION['userID'])){
        header("Location: userLoginForm.php");
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Dental Clinic</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/userDashboard.css?v=<?php echo time() ?>">

    <!-- JS -->
    <script defer src="../src/javascript/userDashboard.js?v=<?php echo time() ?>"></script>

    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <main>
        <aside class="sideBar">
            <div class="profile">
                <img src="../src/images/Profile.png" alt="profile picture" />
                <h3 id="profileName"><?php echo $_SESSION['firstname'] . " " . $_SESSION['surname'];?> </h3>
            </div>

            <div class="navBtn">
                <a href="#">
                    <button type="button">
                        <i class="bi bi-person-lines-fill"></i>
                        <span>My profile</span>
                    </button>
                </a>

                <a href="#">
                    <button type="button">
                        <i class="bi bi-calendar-week-fill"></i>
                        <span>Appoinments</span>
                    </button>
                </a>

                <a href="#">
                    <button type="button">
                        <i class="bi bi-gear-fill"></i>
                        <span>Settings</span>
                    </button>
                </a>
            </div>

            <div class="logout">
                <a href="logOut.php">
                    <button id="logOut">Log out</button>
                </a>
            </div>
        </aside>

        <section class="contentContainer">
            <div class="logo">
                <img src="../src/images/logo.png" alt="Dental Clinic logo">
                <i class="bi bi-envelope" id="email">
                    <small id="notification"></small>
                </i>

                <!-- Message Receiver -->
                <div class="messages">
                    <h4 style="
                    text-align:center;
                    padding:5px;
                    opacity:.4;
                    letter-spacing:1px;
                    ">INBOX</h4>

                    <!-- Show message/notifications -->
                    <?php
                        $messages = $queryMethods->getMessages($userID);
                        if (!empty($messages)) {
                            foreach ($messages as $message) {
                                echo '<div class="message">';
                                echo '<button class="subject"><span class="subjectTittle" style="text-transform:uppercase;">' . $message['subject'] . '</span> <i class="bi bi-envelope-fill" id="envelop"></i></button>';
                                echo '<div class="messageBody">';
                                echo '<p id="from">From: ' . $message['from'] . '</p>';
                                echo '<p id="letter">' . $message['message'] . '</p>';
                                echo '<p id="dateTime">' . $message['date_time'] . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                </div>



            </div>

            <div class="content">
                <div class="btns">
                    <a href="userAppointmentForm.php">
                        <button id="startBtn">
                            <i class="bi bi-plus"></i>
                            <span>New appointment</span>
                        </button>
                    </a>

                    <a href="#">
                        <button id="midBtn">
                            <i class="bi bi-arrow-clockwise"></i>
                            <span>Pending appointments</span>
                        </button>
                    </a>

                    <a href="#">
                        <button id="endBtn">
                            <i class="bi bi-clipboard2"></i>
                            <span>History</span>
                        </button>
                    </a>
                </div>


                <div class="tag">
                    <small>
                        Welcome to the Dental Clinic
                    </small>
                    <h2>
                        Caring for all you
                        family’s dental need
                    </h2>
                </div>

                <div class="footer">
                    <div class="description">
                        <h3>
                            Schedule your first visit
                        </h3>
                        <small>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio dolore laborum fugit odit
                            dolorum magni earum accusantium! Rem, dolores sint?
                        </small>
                    </div>

                    <div class="appoinmentBtn">
                        <a href="userAppointmentForm.php">
                            <button>
                                Schedule Your Visit
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
</body>

</html>