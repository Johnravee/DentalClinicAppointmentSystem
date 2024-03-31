<?php
require_once('../database/connection/database.php');
require_once('../database/models/queryClass.php');

//CHECK IF THE SSESSION IS SET
if(!isset($_SESSION['adminID'])){
    header("Location: adminLoginForm.php");
    return;
}

$queryMethods = new selectQueries($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CLIENTS INFORMATION EDITOR | Dental Clinic</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>


<style>
.card-body img {
    height: 100px;
    width: 100px;
    border-radius: 50%;
}

.card {
    width: 48%;
}
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" href="adminDashboard.php" role="button">
                        Back
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                            <li class="nav-item">
                                <a href="approval_appointmentAdmin.php" class="nav-link active">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Approved / Disapproved
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content mt-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 w-100 d-flex   flex-row flex-wrap">

                            <?php
                            $selectedDatas = $queryMethods->getPendingAppointments();
                            
                            foreach($selectedDatas as $selectedData){
                              echo '
                              <div class="card m-2">
                                <div class="card-header">
                                    <h3 class="card-title">Approved / Disapproved</h3>
                                </div>
                                <div class="card-body col-md-12">
                                    <form action="/DentalClinicAppointmentSystem/database/controllers/updateAppointmentStatus.php" method="post">
                                        <div class="col-md-9">
                                            <h4 class="text-center" style="font-color: #003556;">New meeting booked!
                                            </h4>
                                            <div class="col text-center mt-2 p-2">';
                                               
                                         $profileImage =  $selectedData['profileImage'];
                                            //  file information storage
                                            $openImageInfo = finfo_open(FILEINFO_MIME);
                                            
                                            if($openImageInfo){
                                                $imageExtensionType = finfo_buffer($openImageInfo,$profileImage);
                                                $getTheMimeType = strtok($imageExtensionType, ';');

                                                switch ($getTheMimeType) {
                                                case "image/jpeg":
                                                    echo '<img  src="data:image/jpeg;base64,'.base64_encode($profileImage) . '"  />';
                                                    break;

                                                case "image/png":
                                                    echo '<img  src="data:image/png;base64,'.base64_encode($profileImage) . '" />';
                                                    break;

                                                case "image/jpg":
                                                    echo '<img  src="data:image/jpg;base64,'.base64_encode($profileImage) . '" />';
                                                    break;

                                                default:
                                                    echo '<img  src="../src/images/Profile.png"/>';
                                                    break;
                                                }
                                            }
                                    
                                            
                       echo ' </div>
                        <div class="offset-3 mt-2 p-2 w-100">
                            <div class="form-group row w-100">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Consultant</label>
                                <div class="col-sm-8">
                                <input type="text" name="consultant" readonly class="form-control-plaintext"
                                value="'.$selectedData['Consultant'].'">
                                <input name ="appoinmentID" value="'.$selectedData['appointment_ID'].'" hidden/>
                                <input name ="customer_ID" value="'.$selectedData['customer_ID'].'" hidden/>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="date" readonly class="form-control-plaintext"
                                        value="'.$selectedData['Datee'].'">
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Time</label>
                                <div class="col-sm-8">
                                    <input type="text" name="time" readonly class="form-control-plaintext"
                                        value="'.$selectedData['Timee'].'">
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Appointment Type</label>
                                <div class="col-sm-8">
                                    <input type="text" name="appointmentType" readonly class="form-control-plaintext"
                                        value="'.$selectedData['appointmentType'].'">
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Transaction No.</label>
                                <div class="col-sm-8">
                                    <input type="text" name="transactionNumber" readonly class="form-control-plaintext"
                                        value="'.$selectedData['transactionNumber'].'">
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <input type="text" name="status" readonly class="form-control-plaintext"
                                        value="'.$selectedData['Statuss'].'">
                                </div>
                            </div>
                        </div>

                        <div class="col text-center mt-2 p-2">
                            <button type="submit" name="Approve" class="btn btn-success"
                                style="border-radius: 24px!important;">Approved</button>&nbsp;&nbsp;
                            <button type="submit" name="Decline" class="btn btn-default"
                                style="border-radius: 24px!important;">Declined</button>
                        </div>
                    </div>
                    </form>
                </div>
        </div>';

        
        }










        ?>



                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="updateUsersProfile" tabindex="-1" role="dialog"
        aria-labelledby="updateUsersProfileLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mr-2" id="updateUsersProfileLabel"><i class="fas fa-edit"></i> Update User
                        Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" required>
                            <option value=""> -- </option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</body>

</html>