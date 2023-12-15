<?php
require_once('../database/connection/database.php');
require_once('../database/models/queryClass.php');

//CHECK IF THE SSESSION IS SET
if(!isset($_SESSION['adminID'])){
    header("Location: adminLoginForm.php");
    return;
}
    $queryMethods = new selectQueries($conn);
    $rows = $queryMethods->getMyAccountDetails('adminaccounts', $_SESSION['adminID']);

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

    $cancelledAppointmentCounts = $queryMethods->getAllStatusCounts('Cancelled');
    $pendingAppointmentCounts = $queryMethods->getAllStatusCounts('Pending');
    $approvedAppointmentCounts = $queryMethods->getAllStatusCounts('Approved');
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

    <!-- JS -->
    <script defer src="../src/javascript/userDashboard.js?v=<?php echo time() ?>"></script>

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
                    <a href="approval_appointmentAdmin.php">
                        <p id="apptNotif">
                            <?php  echo $pendingAppointmentCounts ?>
                        </p>
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

                <a href="adminProfile.php" id="gear"><button><i class="bi bi-gear"></i></button></a>
            </div>
        </aside>


        <section class="dashBoard">
            <div class="header">
                <div class="pageTittle">
                    <h1>Dashboard</h1>
                </div>

                <div class="profileImg">
                    <h1>
                        <?php echo $rows['firstName'] . " " . $rows['surName'] ?>
                    </h1>
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
                </div>
            </div>

            <div class="monitor">
                <div class="card">
                    <h4><i class="bi bi-clipboard2-x-fill"></i></h4>
                    <div class="label">
                        <h2>Cancelled Appoinments</h2>
                        <h1><?php echo $cancelledAppointmentCounts ?></h1>
                    </div>
                </div>

                <div class="card" style="background-color: #F0AD4E;">
                    <h4 style="color: #332D2D;"><i class="bi bi-hourglass-split"></i></h4>
                    <div class="label">
                        <h2>Pending Appoinments</h2>
                        <h1><?php echo $pendingAppointmentCounts ?></h1>
                    </div>
                </div>

                <div class="card" style="background-color: #5CB85C;">
                    <h4><i class="bi bi-clipboard-check-fill"></i></h4>
                    <div class="label">
                        <h2>APPROVED Appoinments</h2>
                        <h1><?php echo $approvedAppointmentCounts ?></h1>
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