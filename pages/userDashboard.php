<?php

require_once("../database/models/queryClass.php");
require_once('../database/connection/database.php');
$queryMethods = new selectQueries($conn);
$updateQueryMethods = new updateQuries($conn);
$userID = $_SESSION['userID'];
    // CHECK IF SESSION IS SET 
    //Prevent redirecting to this page for those who didn't logged in
    if(!isset($_SESSION['userID'])){
        header("Location: userLoginForm.php");
        return;
    }

    $rows = $queryMethods->getMyAccountDetails('useraccounts',$userID);



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
                <!-- GET THE PROFILE IMAGE FROM USERACCOUNTS -->
                <?php
                     $profileImage =  $rows['profileImage'];
                    //  file information storage
                     $openImageInfo = finfo_open(FILEINFO_MIME);
                    
                     if($openImageInfo){
                        $imageExtensionType = finfo_buffer($openImageInfo,$profileImage);
                        $getTheMimeType = strtok($imageExtensionType, ';');

                        switch ($getTheMimeType) {
                        case "image/jpeg":
                            echo '<img  src="data:image/jpeg;base64,'.base64_encode($profileImage) . '" />';
                            break;

                        case "image/png":
                            echo '<img  src="data:image/png;base64,'.base64_encode($profileImage) . '" />';
                            break;

                        case "image/jpg":
                            echo '<img  src="data:image/jpg;base64,'.base64_encode($profileImage) . '"/>';
                            break;

                        default:
                            echo '<img  src="../src/images/Profile.png"/>';
                            break;
                        }
                     }
                    ?>
                <h3 id="profileName"><?php echo $rows['firstName'] . " " . $rows['surName']?> </h3>
            </div>

            <div class="navBtn">
                <a href="userProfile.php">
                    <button type="button">
                        <i class="bi bi-person-lines-fill"></i>
                        <span>My profile</span>
                    </button>
                </a>

                <a href="homepage.php">
                    <button type="button">
                        <i class="bi bi-house-door-fill"></i>
                        <span>Homepage</span>
                    </button>
                </a>

                <a href="logOut.php">
                    <button type="button">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </a>
        </aside>

        <section class="contentContainer">
            <div class="logo">
                <a href="homepage.php">
                    <img src="../src/images/logo.png" alt="Dental Clinic Logo" />
                </a>
                <i class="bi bi-envelope" id="email">
                    <small id="notification"></small>
                </i>

                <!-- Message Receiver -->

                <div class="messages">
                    <button id="closeMessageModal" type="button">X</button>
                    <h4 style="
                        text-align:center;
                        padding:5px;
                        opacity:.4;
                        letter-spacing:1px;
                        ">INBOX</h4>


                    <h3 id="noMessageText">NO MESSAGES</h3>

                    <div class="mails">
                        <!-- Show message/notifications -->
                        <?php
                            $messages = $queryMethods->getMessages($userID);
                            if (!empty($messages)) {
                                foreach ($messages as $message) {
                                    echo '<form class = "deleteForm" action="/CLINICAPPOINTMENTSYS/database/controllers/deleteMessagesController.php" method="post">';
                                    echo '<div class="message">';
                                    echo '<input name ="userID" value ="'.$userID.'" hidden/>';
                                    echo '<p class="subject"><span class="subjectTittle" style="text-transform:uppercase;">' . $message['subjectt'] . '</span> <i class="bi bi-envelope-fill" id="envelop"></i></p>';
                                    echo '<div class="messageBody">';
                                    echo '<p id="from">From: ' . $message['fromm'] . '</p>';
                                    echo '<p id="letter">' . $message['messages'] . '</p>';
                                    echo '<p id="dateTime">' . $message['date_time'] . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</form>';
                                }
                            }
                            ?>
                    </div>


                    <div class="deleteBTN">
                        <button id="deleteMessages" type="button">Delete</button>
                    </div>

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

                    <a href="userPendingAppointments.php">
                        <button id="midBtn">
                            <i class="bi bi-arrow-clockwise"></i>
                            <span>Pending appointments</span>
                        </button>
                    </a>

                    <a href="userAppointmentHistory.php">
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
                        We Care for Your
                        Family’s Dental Need
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