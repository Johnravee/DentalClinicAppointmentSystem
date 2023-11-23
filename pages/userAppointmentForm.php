<?php
session_start();

// CHECK IF SESSION IS SET 
if(!isset($_SESSION['userID'])){
    header('Location: userLoginForm.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment | Dental Clinic</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- JS -->
    <script defer src="../src/javascript/userAppointmentForm.js?v=<?php echo time() ?>"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/userAppoinmentForm.css?v=<?php echo time() ?>">
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>



    <!-- Form modal -->
    <div class="modalScreen">
        <div class="modal">
            <button class="modalClose" type="button">X</button>
            <div class="modalTittle">
                <h2>Check details</h2>
            </div>

            <div class="details">
                <form action="../database/controllers/appoinmentsController.php" method="post">
                    <div class="modalInput">
                        <label for="appointedTime">APPOINTED TIME</label>
                        <input type="text" name="appointedTime" id="appointedTime" readonly />
                    </div>

                    <div class="modalInput">
                        <label for="appointedDate">APPOINTED DATE</label>
                        <input type="text" name="appointedDate" id="appointedDate" readonly />
                    </div>


                    <div class="modalInput">
                        <label for="appointmentTypeModal">APPOINTMENT TYPE</label>
                        <input type="text" name="appointmentTypeModal" id="appointmentTypeModal" readonly />
                    </div>

                    <div class="modalInput">
                        <label for="consultant">CONSULTANT</label>
                        <input type="text" name="consultant" id="consult" readonly />
                    </div>

                    <div class="modalInput">
                        <input type="text" name="transactionNumber" id="transactionNumber" hidden readonly />
                    </div>

                    <div class="modalSave">
                        <button id="book" type="submit">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <header>
        <a href="userDashboard.php"><img src="../src/images/logo.png" alt="Dental Clinic Logo" /></a>
        <h1>APPOINMENT FORM</h1>
    </header>

    <main>
        <section class="form-inputs" id="style-11">
            <div class="backBtn">
                <a href="userDashboard.php"><i class="bi bi-arrow-left-circle"></i></a>
            </div>

            <h1 id="timeSchedText">SELECT TIME SCHEDULE</h1>
            <div class="scheduleList">
                <ul class="timeList">
                    <li class="timeItem">
                        <label for="9-10">9:00-10:00AM</label>
                        <input type="radio" name="scheduledTime" id="9-10" value="9:00-10:00AM" required>
                    </li>
                    <li class="timeItem">
                        <label for="10-11">10:00-11:00AM</label>
                        <input type="radio" name="scheduledTime" id="10-11" value="10:00-11:00AM" required>
                    </li>
                    <li class="timeItem">
                        <label for="1-2">1:00-2:00PM</label>
                        <input type="radio" name="scheduledTime" id="1-2" value="1:00-2:00PM" required>
                    </li>
                    <li class="timeItem">
                        <label for="2-3">2:00-3:00PM</label>
                        <input type="radio" name="scheduledTime" id="2-3" value="2:00-3:00PM" required>
                    </li>
                    <li class="timeItem">
                        <label for="3-4">3:00-4:00PM</label>
                        <input type="radio" name="scheduledTime" id="3-4" value="3:00-4:00PM" required>
                    </li>
                    <li class="timeItem">
                        <label for="4-5">4:00-5:00PM</label>
                        <input type="radio" name="scheduledTime" id="4-5" value="4:00-5:00PM" required>
                    </li>
                </ul>
            </div>

            <div class="inputGroup">
                <div class="date">
                    <label for="DATE">DATE</label>
                    <input type="date" name="schedDate" id="DATE" required />
                </div>



                <div class="appointmentType">
                    <label for="type">Appointment Type</label>
                    <select name="appointmentType" id="type" required>
                        <option value="Check Up" selected>Check up</option>
                        <option value="Tooth Cleaning">Teeth Cleaning</option>
                        <option value="Teeth Filling">Teeth Filling</option>
                        <option value="Teeth Extraction">Teeth Extraction</option>
                        <option value="Teeth X-ray">Teeth X-Ray</option>
                        <option value="Orthodontic">Orthodontic</option>
                        <option value="Teeth Root Canal">Teeth Root Canal</option>
                        <option value="Cosmetic Dentistry">Cosmetic Destistry</option>
                    </select>
                </div>

                <div class="Consultants">
                    <label for="consultants">Consultants</label>
                    <select id="consultants" required>
                        <option value="Dr. John Doe" selected>Dr. John Doe</option>
                        <option value="Dr. Will Smith">Dr. Will Smith</option>
                        <option value="Dr. John Williams">Dr. John Williams</option>
                        <option value="Dr. Marites Chavez">Dr. Marites Chavez</option>
                        <option value="Dr. Rose Santos">Dr. Rose Santos</option>
                    </select>
                </div>

                <div class="btn">
                    <button id="save">Save</button>
                </div>
            </div>

        </section>

        <section class="banner">
            <img src="../src/images/brokenTooth.png" alt="Banner">
        </section>
    </main>

</body>

</html>