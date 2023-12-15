<?php
require_once('../database/connection/database.php');
require_once('../database/models/queryClass.php');

// CHECK IF SESSION IS SET 
    //Prevent redirecting to this page for those who didn't logged in
    if(!isset($_SESSION['userID'])){
        header("Location: userLoginForm.php");
        return;
    }

    $queryMethods = new selectQueries($conn);
    $rows = $queryMethods->getMyAccountDetails('useraccounts',$_SESSION['userID']);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Dental Clinis</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- JS -->
    <script defer src="../src/javascript/userProfile.js?v=<?php echo time() ?>"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/userProfile.css?v=<?php echo time() ?>">

    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body>
    <header>
        <div class="logoPageTitle">

            <img src="../src/images/logo.png" alt="DentalClinicLogo" readonly />


            <h1>My Profile</h1>

        </div>
        <div class="backBtn">
            <a href="userDashboard.php"><button type="button"><i class="bi bi-arrow-left-circle"></i></button></a>
        </div>
    </header>

    <main>
        <form action="/CLINICAPPOINTMENTSYS/database/controllers/updateProfileController.php"
            enctype="multipart/form-data" method="post">
            <aside>
                <div class="profileImg">
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

                <div class="sideBtn">
                    <input type="text" name="userProfileID" value="<?php echo $rows['profile_ID'] ?>" hidden />
                    <label for="fileInputBtn">Select Profile</label>
                    <input class="FileInputBtn" type="file" name="profileImg" accept="image/jpg, image/jpeg, image/png"
                        hidden id="fileInputBtn" class="input" readonly />
                </div>
            </aside>


            <section>
                <div class="formContent">
                    <div class="formContainer">
                        <h1 id="editModeIndicator">YOU ARE IN EDIT MODE <i class="bi bi-pencil-square"></i></h1>
                        <div class="formGroup">
                            <label for="firstName">FIRSTNAME</label>
                            <input id="firstName" type="text" name="firstName" class="input"
                                value="<?php echo $rows['firstName'] ?>" readonly />
                        </div>


                        <div class="formGroup">
                            <label for="middleName">MIDDLENAME</label>
                            <input id="middleName" type="text" name="middleName" class="input"
                                value="<?php echo $rows['middleName'] ?>" readonly />
                        </div>

                        <div class="formGroup">
                            <label for="surName">LASTNAME</label>
                            <input id="surName" type="text" name="surName" class="input"
                                value="<?php echo $rows['surName'] ?>" readonly />
                        </div>

                        <div class="formGroup">
                            <label for="contact">CONTACT</label>
                            <input id="contact" type="text" name="contact" class="input"
                                value="<?php echo $rows['contact'] ?>" readonly />
                        </div>

                        <div class="formGroup">
                            <label for="birthDate">BIRTH DATE</label>
                            <input id="birthDate" type="date" name="birthDate" class="input"
                                value="<?php echo $rows['birthDate'] ?>" readonly />
                        </div>

                        <div class="formGroup">
                            <label for="address">ADDRESS</label>
                            <input id="address" type="text" name="address" class="input"
                                value="<?php echo $rows['addresss'] ?>" readonly />
                        </div>


                        <div class="formBtns">
                            <button type="button" id="editMode">EDIT</button>
                            <button type="submit">SAVE</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </main>
</body>

</html>