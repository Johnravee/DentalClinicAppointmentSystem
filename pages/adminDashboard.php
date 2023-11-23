<?php
session_start();
require_once('../database/connection/database.php');

//CHECK IF THE SSESSION IS SET
if(!isset($_SESSION['adminID'])){
    header("Location: adminLoginForm.php");
}

try{
    $appointmentType = array();
    $appointedClient = array();

    //Get the total appointedCLient to every appointment type
    $stmt1 = "SELECT appointmentType, Statuss, COUNT(appointmentType) AS totalAppointedClient FROM appointments WHERE Statuss = 'Approved'  GROUP BY appointmentType";
    // Prepare the statement
    $query1 = $conn->prepare($stmt1);
    // Execute the statement
    if ($query1->execute()) {
        $query1->bind_result($appointmentTypeResult, $status ,$totalAppointedClientResult);

        while ($query1->fetch()) {
            $appointmentType[] = $appointmentTypeResult;
            $appointedClient[] = $totalAppointedClientResult;
        }
    }

    //GET the total pending status in the table
    $stmt2 = "SELECT COUNT(Statuss) AS statusCounts FROM appointments WHERE Statuss = 'Pending'";
    $query2 = $conn->query($stmt2);
    $resultQuery2 = $query2->fetch_assoc();
    $pedingStatusCounts = $resultQuery2['statusCounts'];

    //GET the total cancelled status in the table
    $stmt3 = "SELECT COUNT(Statuss) AS statusCounts FROM appointments WHERE Statuss = 'Cancelled'";
    $query3 = $conn->query($stmt3);
    $resultQuery3 = $query3->fetch_assoc();
    $cancelledStatusCounts = $resultQuery3['statusCounts'];

    //Get the total approved status in the table
    $stmt4 = "SELECT COUNT(Statuss) AS statusCounts FROM appointments WHERE Statuss = 'Approved'";
    $query4 = $conn->query($stmt4);
    $resultQuery4 = $query4->fetch_assoc();
    $approvedStatusCounts = $resultQuery4['statusCounts']; 

    

    
}catch(Exception){
    throw new Exception("FAILED BINDING COLUMNS");
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
    <link rel="stylesheet" href="../src/styles/adminDashboard.css?v=<?php echo time() ?>">
    <!-- CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

    <main>
        <aside>
            <div class="asideContent">
                <h1>OPTIONS</h1>

                <div class="btns">
                    <a href="#">
                        <button>APPROVAL</button>
                    </a>

                    <a href="adminCancelledAppointmentView.php">
                        <button>CANCELLED</button>
                    </a>

                    <a href="adminApprovedAppoinmentView.php">
                        <button>APPROVED</button>
                    </a>

                    <a href="adminPendingAppointmentsView.php">
                        <button>PENDINGS</button>
                    </a>
                </div>

                <a href="#" id="gear"><button><i class="bi bi-gear"></i></button></a>
            </div>
        </aside>


        <section class="dashBoard">
            <div class="header">
                <div class="pageTittle">
                    <h1>Dashboard</h1>
                </div>

                <div class="profileImg">
                    <h1>
                        <?php echo $_SESSION['firstname']. " " .$_SESSION['surname']?>
                    </h1>
                    <img src="../src/images/Profile.png" alt="profile picture">
                </div>
            </div>

            <div class="monitor">
                <div class="card">
                    <h4><i class="bi bi-clipboard2-x-fill"></i></h4>
                    <div class="label">
                        <h2>Cancelled Appoinments</h2>
                        <h1><?php echo $cancelledStatusCounts ?></h1>
                    </div>
                </div>

                <div class="card" style="background-color: #F0AD4E;">
                    <h4 style="color: #332D2D;"><i class="bi bi-hourglass-split"></i></h4>
                    <div class="label">
                        <h2>Pending Appoinments</h2>
                        <h1><?php echo $pedingStatusCounts ?></h1>
                    </div>
                </div>

                <div class="card" style="background-color: #5CB85C;">
                    <h4><i class="bi bi-clipboard-check-fill"></i></h4>
                    <div class="label">
                        <h2>APPROVED Appoinments</h2>
                        <h1><?php echo $approvedStatusCounts ?></h1>
                    </div>
                </div>
            </div>

            <div class="graph">
                <canvas id="barGraph"></canvas>
            </div>
        </section>




    </main>
</body>
<script>
const barGraph = document.getElementById('barGraph');

new Chart(barGraph, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($appointmentType) ?>,
        datasets: [{
            label: 'Number of appointed clients',
            data: <?php echo json_encode($appointedClient) ?>,
            borderWidth: 2,
            backgroundColor: ["#14AE5C", "#F24822", "#9747FF", "#FFCD29", "#626262", "#1F1C1C",
                "#D726BA"
            ]
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                labels: {

                    // This more specific font property overrides the global property
                    font: {
                        size: 20
                    }

                }
            }
        }
    },

});
</script>

</html>