<?php
require_once('../database/connection/database.php');
require_once('../database/models/queryClass.php');

$queryMethods = new selectQueries($conn);

// CHECK IF SESSION IS SET 
    //Prevent redirecting to this page for those who didn't logged in
    if(!isset($_SESSION['userID'])){
        header("Location: userLoginForm.php");
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/userPendingAppointments.css?v=<?php echo time() ?>">
    <title>Appointment Pending</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- JS -->
    <script defer src="../src/javascript/userPendingAppt.js?v=<?php echo time()?>"></script>

    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>


<body>
    <div class="search-container">
        <div class="tit">
            <h2>Search appointment</h2>
            <div class="backBtn">
                <a href="userDashboard.php"><i class="bi bi-arrow-left-circle"></i></a>
            </div>
        </div>

        <input type="text" id="searchInput" placeholder="Transaction #">
    </div>

    <div class="wrapper">
        <div class="container">
            <?php
            $selectedDatas = $queryMethods->getPendingAppointmentsOfUser($_SESSION['userID']);

            foreach($selectedDatas as $selectedData){
                echo '
                <form action="/DentalClinicAppointmentSystem/database/controllers/updateAppointmentStatus.php" method="post">
                 <h1>Pending Appointment </h1>

                <div class="appointment-details">
                    <p id="transactionNumber"><strong>Transaction No. :</strong> '.$selectedData['transactionNumber'].'</p>
                    <input value="'. $selectedData['transactionNumber'].'" name="transac" hidden/>
                    <p><strong>Date :</strong> '.$selectedData['Datee'].'</p>
                    <p><strong>Time:</strong> '.$selectedData['Timee'].'</p>
                    <p><strong>Appointment Type :</strong> '.$selectedData['appointmentType'].'</p>
                    <p><strong>Consultant :</strong> '.$selectedData['Consultant'].'</p>
                    <p><strong>Status :</strong> '.$selectedData['Statuss'].'</p>
                    <input name = "appointmentID" value ="'.$selectedData['appointment_ID'].'" hidden />
                    <input name = "customerID" value ="'.$selectedData['customer_ID'].'"  hidden/>
                </div>

            <button type="submit" name="cancel" class="cancel-btn">Cancel Appointment</button>
        </form>
         
                ';
            }

        ?>
        </div>
    </div>


</body>

</html>