<?php

require_once('../database/connection/database.php');
require_once('../database/models/queryClass.php');

if(!isset($_SESSION['adminID'])){
    header("Location: adminLoginForm.php");
    return;
}


$queryMethods = new selectQueries($conn);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cancelled Appointments | Dental Clinic</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/admincancelledappointment.css?v=<?php echo time() ?>">

    <!-- JS -->
    <script defer src="../src/javascript/StatusChecker.js?v=<?php echo time() ?>"></script>
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <a href="userDashboard.php"><img src="../src/images/logo.png" alt="Dental Clinic Logo" /></a>
        <h1>CANCELLED APPOINMENTS</h1>
    </header>

    <main>
        <div class="search-container">
            <div class="tit">
                <h2>Search appointment</h2>
                <div class="backBtn">
                    <a href="adminDashboard.php"><i class="bi bi-arrow-left-circle"></i></a>
                </div>
            </div>

            <input type="text" id="searchInput" placeholder="Transaction #">
        </div>

        <div class="tableContent">
            <table>
                <thead>
                    <tr class="main-heading">
                        <th>Date</th>
                        <th>Transaction #</th>
                        <th>Time</th>
                        <th>Consultant</th>
                        <th>Appoinment Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- FETCH ALL CANCELLED DATA FROM DATABASE -->
                    <?php
                $selectedData = $queryMethods->getCancelledAppointments();

             foreach ($selectedData as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['Datee'] . "</td>";
                    echo "<td class='transactionNumbers'>" . $row['transactionNumber'] . "</td>";
                    echo "<td>" . $row['Timee'] . "</td>";
                    echo "<td>" . $row['Consultant'] . "</td>";
                    echo "<td>" . $row['appointmentType'] . "</td>";
                    echo "<td id='statuss'>" . $row['Statuss'] . "</td>";
                    echo "</tr>";
                }
            ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>