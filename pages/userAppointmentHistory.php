<?php   
require_once('../database/models/queryClass.php');
require_once('../database/connection/database.php');

$queryMethods = new selectQueries($conn);
// CHECK IF SESSION IS SET 
if(!isset($_SESSION['userID'])){
    header("Location: /CLINICAPPOINTMENTSYS/pages/userLoginForm.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/userappointmentHistory.css?v=<?php echo time() ?>">
    <title>Appointment History</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- JS -->
    <script defer src="../src/javascript/apptHistoryUser.js?v=<?php echo time() ?>"></script>

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

    <div class="container">
        <h1>Appointment History</h1>

        <div class="appointment-history">
            <table>
                <thead>
                    <tr>
                        <th>Transaction No.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Appointment Type</th>
                        <th>Consultant</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectedDatas = $queryMethods->getHistoryAppointmentsOfUser($_SESSION['userID']);
                    
                        foreach($selectedDatas as $selectedData){
                            echo '<tr class="tableRowData">';
                            echo '<td id="transactionNumbers">'.$selectedData['transactionNumber'].'</td>';
                            echo '<td>'.$selectedData['datee'].'</td>';
                            echo '<td>'.$selectedData['Timee'].'</td>';
                            echo '<td>'.$selectedData['appointmentType'].'</td>';
                            echo '<td>'.$selectedData['Consultant'].'</td>';
                            echo '<td>'.$selectedData['Statuss'].'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>