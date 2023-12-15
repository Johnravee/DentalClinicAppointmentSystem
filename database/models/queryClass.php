<?php
//Start the session when this file used
session_start();
//Parent class 
class insertQueries{
       //PROPERTY
       protected $db;

    //    CONSTRUCTOR
    public function __construct($connection){
        $this->db = $connection;
    }
    //METHOD TO  insert data table
    public function insertAccountsData($tableName ,$email, $firstName, $middleName, $surName, $contact, $birthDate, $gender, $employeeID, $addresses, $password, $accountType){
        
        try{
            if($tableName === 'adminaccounts')
            {
                $adminAccountInsertData = "INSERT INTO $tableName (email, firstName, middleName, surName, contact, birthDate, gender, employeeID, addresss, passwords, account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $this->db->prepare($adminAccountInsertData);
                $query->bind_param('sssssssssss',$email, $firstName, $middleName, $surName, $contact, $birthDate, $gender, $employeeID, $addresses, $password, $accountType);
            
                if($query->execute()) return true;
            }
            else if($tableName === 'useraccounts'){
                 $userAccountInsertData = "INSERT INTO $tableName (email, firstName, middleName, surName, contact, gender, birthDate, addresss, passwords, account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $this->db->prepare($userAccountInsertData);
                $query->bind_param('ssssssssss', $email, $firstName, $middleName, $surName, $contact, $gender, $birthDate, $addresses, $password, $accountType);

                if($query->execute()) return true;
            }
            

        }catch(Exception){
            throw new Exception("QUERY CLASS FAILED INSERTION");
        }
        
    }


    //METHOD TO INSERT APPOINTMENTS DATA
    public function insertAppoinmentsData($customer_ID, $date, $time, $transactionNumber, $status, $appointmentType,  $Consultant){
        
        try{
            
            $insertAppoinmentData = "INSERT INTO appointments (customer_ID, datee, Timee, Consultant,transactionNumber, Statuss, appointmentType) VALUES(?, ?, ?, ?, ?, ?, ?)";

            $query = $this->db->prepare($insertAppoinmentData);
            $query->bind_param('sssssss', $customer_ID, $date, $time, $Consultant, $transactionNumber, $status, $appointmentType); 
            
            if($query->execute()){
                
                return true;
            }
        }catch(Exception){
            throw new Exception("FAILED TO INSERT APPOINTMENT DATA");
        }

    }

    //SEND NOTIFICATION TO THE USER
    public function notificationSender($customer_ID, $from, $message, $subject){
        $notificationInsertData = "INSERT INTO messages (customer_ID, fromm, messages, subjectt, date_time) VALUES (?, ?, ?, ?, NOW())";
$query = $this->db->prepare($notificationInsertData);
$query->bind_param('isss', $customer_ID, $from, $message, $subject);
        if($query->execute()){
            return true;
        }

    }




}


// Child class that inherit the property of parent class
class selectQueries extends insertQueries{

    // INHERIT THE CONSTRUCTOR/PROPERTIES OF PARENT CLASS(insertQueries)
    public function __construct($connection){
        parent::__construct($connection);
        
    }

    //METHOD to select useraccounts Table
    public function userLogIn($email, $password){

       try{
         $userLogin  = "SELECT * FROM useraccounts WHERE email = ?";
         $query = $this->db->prepare($userLogin);
         $query->bind_param('s', $email);
         $query->execute();
         $result = $query->get_result();
         $row = $result->fetch_assoc();

            $databasePassword = $row['passwords'];

            $verifyPassword = password_verify($password, $databasePassword);

            if($verifyPassword === true){
                $_SESSION['userID'] = $row['profile_ID'];
                return true;
            }
       }catch(Exception){
         throw new Exception("login Failed");
       }
    }

    //METHOD to select adminaccounts Table
    public function adminLogin($employeeID, $password){
         try{
         $adminLogin  = "SELECT * FROM adminaccounts WHERE employeeID = ?";
         $query = $this->db->prepare($adminLogin);
         $query->bind_param('s', $employeeID);
         $query->execute();
         $result = $query->get_result();
         $row = $result->fetch_assoc();

            $databasePassword = $row['passwords'];

            $verifyPassword = password_verify($password, $databasePassword);

            if($verifyPassword === true){
                $_SESSION['adminID'] = $row['adProfile_ID'];
                return true;
            }
       }catch(Exception){
         throw new Exception("Administrator login Failed");
       }
    }

    //METHOD TO Get the admins message to the clients
    public function getMessages($userID){
        try{
            $selectMessage = "SELECT * FROM messages WHERE customer_ID = ? ";
            $query = $this->db->prepare($selectMessage);
            $query->bind_param('i', $userID);
            
            $query->execute();
            $result = $query->get_result();
    
            $rows = array(); 
    
                if ($result) {
                
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                    return $rows;
                } 
        }catch(Exception){
            throw new Exception("Failed to get messages");
        }
    }

    //METHOD TO GET APPROVED APPOINTMENTS
    public function getApprovedAppointments(){
        $selectApprovedAppoinments = "SELECT * FROM appointments WHERE Statuss = 'Approved' ORDER BY datee ASC";
        $query = $this->db->query($selectApprovedAppoinments);
        $result = array();


        while($row = $query->fetch_assoc()){
            $result[] = $row;

        }
        return $result;
        
       
    } 

    // METHOD TO GET CANCELLED APPOINMENTS
    public function getCancelledAppointments(){
        $selectApprovedAppoinments = "SELECT * FROM appointments WHERE Statuss = 'Cancelled' ORDER BY datee ASC";
        $query = $this->db->query($selectApprovedAppoinments);
        $result = array();


        while($row = $query->fetch_assoc()){
            $result[] = $row;

        }
        return $result;
        
       
    } 


    // METHOD TO GET PENDING APPOINMENTS
    public function getPendingAppointments(){
        try{
          
        $selectApprovedAppoinments = "SELECT * 
FROM useraccounts 
RIGHT JOIN appointments ON appointments.customer_ID = useraccounts.profile_ID 
WHERE Statuss = 'Pending' 
ORDER BY appointments.datee; 
";
        $query = $this->db->query($selectApprovedAppoinments);
        $result = array();


        while($row = $query->fetch_assoc()){
            $result[] = $row;

        }

        return $result;
        }catch(Exception){
            throw new Exception("ERROR GETTING APPOINTMENTS");
        }
        
       
    }
    

  

    //getAccountDetails
    public function getMyAccountDetails($tableName,$tableID){
        
        try{
            if($tableName === 'useraccounts'){
            $selectMyDetails = "SELECT * FROM $tableName WHERE profile_ID = ".$tableID."";
            $query = $this->db->query($selectMyDetails);
            return $query->fetch_assoc();
        }else{
            $selectMyDetails = "SELECT * FROM $tableName WHERE adProfile_ID = $tableID";
             $query = $this->db->query($selectMyDetails);
            return $query->fetch_assoc();
        }
        }catch(Exception){
            throw new Exception("Error GETTING ACCOUNT");
        }
           
    
       
    }


    //GET HISTORY APPOINTMENTS OF USER
    public function getHistoryAppointmentsOfUser($userID){
        try{
            $selectAllDatas = "SELECT * FROM appointments WHERE customer_ID = $userID ORDER BY customer_ID";
            $query = $this->db->query($selectAllDatas);
            $result = array();


        while($row = $query->fetch_assoc()){
            $result[] = $row;

        }
        return $result;
    }catch(Exception){
            throw new Exception("ERROR GETTING APPOINTMENTS");
        }
    }
    

    public function getPendingAppointmentsOfUser($userID){
        try{
            $selectedDatas = "SELECT * FROM appointments WHERE Statuss = 'Pending' AND customer_ID = $userID  ORDER BY datee";
            $query = $this->db->query($selectedDatas);
            $result = array();


        while($row = $query->fetch_assoc()){
            $result[] = $row;

        }
        return $result;
    }catch(Exception){
            throw new Exception("ERROR GETTING APPOINTMENTS");
        }
    }


    // GET THE STATUS OF ALL APPOINMENTS
    public function getAllStatusCounts($statsOfAppointment){
    
       try{
         $stmt = "SELECT COUNT(Statuss) AS statusCounts FROM appointments WHERE Statuss = '$statsOfAppointment'";
        $query = $this->db->query($stmt);
        $resultQuery = $query->fetch_assoc();
        $pendingStatusCounts = $resultQuery['statusCounts'];

        return $pendingStatusCounts;
       }catch(Exception){
        throw new Exception("Error Countings");
       }
    }

    // GET EMAIL
    public function getEmails($email){
        try{
            $getEmailData = "SELECT email FROM (SELECT email FROM useraccounts UNION SELECT email FROM adminaccounts) AS emails WHERE email = ?";
            $query = $this->db->prepare($getEmailData);
            // Bind the parameter
            $query->bind_param('s', $email);

                if ($query->execute()) {
                        $_SESSION['email'] = $email;
                        return true;
                    }

                    }catch(Exception $e){
                        echo $e->getMessage();
                    }
                }   
            


            }





// UPDATE CLASS
class updateQuries extends insertQueries{
     public function __construct($connection){
        parent::__construct($connection);
        
    }


    //UPDATE USER INFORMATION
    public function updateUserProfile($userID, $profileImg, $firstName, $middleName, $surName, $contact, $birthDate, $address){
        try{
            

            // IF NOT EMPTY RUN THE STATEMENT
            if(!empty($profileImg)){
                $updateUserProfile = "UPDATE useraccounts SET profileImage = '$profileImg', firstName = '$firstName', middleName = '$middleName', surName = '$surName', contact = '$contact', birthDate = '$birthDate', addresss = '$address' WHERE profile_ID = $userID";
                $query = $this->db->query($updateUserProfile);
                if($query){
                    return true;
                }
               
                
            }else{
                $updateUserProfile = "UPDATE useraccounts SET firstName = ?, middleName = ?, surName = ?, contact = ?, birthDate = ?, addresss = ? WHERE profile_ID = ?";
                $query = $this->db->prepare($updateUserProfile);
                $query->bind_param('ssssssi', $firstName, $middleName, $surName, $contact, $birthDate, $address, $userID);
                if($query->execute()){
                    return true;
                }
            }


            
        }catch(Exception){
            throw new Exception("FAILED TO UPDATE YOUR PROFILE");
        }


    }

     //UPDATE ADMIN INFORMATION
    public function updateAdminProfile($adminID, $email, $profileImg, $firstName, $middleName, $surName, $contact, $birthDate, $address){

         // IF NOT EMPTY RUN THE STATEMENT
            if(!empty($profileImg)){
                $updateAdminProfile = "UPDATE adminaccounts SET email = '$email' , profileImage = '$profileImg', firstName = '$firstName', middleName = '$middleName', surName = '$surName', contact = '$contact', birthDate = '$birthDate', addresss = '$address' WHERE adProfile_ID = $adminID";
                $query = $this->db->query($updateAdminProfile);
                if($query){
                    return true;
                }
            }else{
                $updateAdminProfile = "UPDATE adminaccounts SET email = ?, firstName = ?, middleName = ?, surName = ?, contact = ?, birthDate = ?, addresss = ? WHERE adProfile_ID   = ?";
                $query = $this->db->prepare($updateAdminProfile);
                $query->bind_param('sssssssi',$email, $firstName, $middleName, $surName, $contact, $birthDate, $address, $adminID);
               if($query->execute()){
                    return true;
               }
            }
        try{

        }catch(Exception){
            throw new Exception("ERROR UPDATING DETAILS");
        }
    }

    //UPDATE APPOINTMENT STATUSS
    public function updateAppointmentStatus($appointmentID, $Status){
        $appointmentUpdate = "UPDATE appointments SET Statuss = '$Status' WHERE appointment_ID = '$appointmentID'";
        $query = $this->db->query($appointmentUpdate);

        if($query){
            return true;
        }
    }


    public function updatePassword($newPassWord){
        try{
            $email = $_SESSION['email'];
            $updateUserPasswordData = "UPDATE useraccounts SET passwords = ? WHERE email = ?";
            $query1 = $this->db->prepare($updateUserPasswordData);
            $query1->bind_param('ss', $newPassWord, $email);
            $query1->execute();
        if($query1->affected_rows > 0){
            echo "<script>alert('YOUR PASSWORD IS UPDATED!')</script>";
            session_start();
            session_destroy();
            session_unset();
            return true;

        }else{
            $updateAdminPasswordData = "UPDATE adminaccounts SET passwords = ? WHERE email = ?";
            $query2 = $this->db->prepare($updateAdminPasswordData);
            $query2->bind_param('ss', $newPassWord, $email);
            if($query2->execute()){
                echo "<script>alert('YOUR PASSWORD IS UPDATED!')</script>";
                session_destroy();
                session_unset();        
                return true;
            }
        }
        }catch(Exception){
            throw new Exception("UPDATING FAILED");
        }
    }

}


class deleteQueries extends insertQueries{

    public function __construct($connection){
        parent::__construct($connection);
    }


    public function deleteData($columnName ,$primaryId, $foreignID, $table){
        
        try{
            if($foreignID){
                $stmt = "DELETE FROM $table WHERE $columnName = $foreignID";
                $query = $this->db->query($stmt);

                if($query) return true;


            }else if($foreignID === null){
                $stmt = "DELETE FROM $table WHERE $columnName = $primaryId";
                $query = $this->db->query($stmt);

                 if($query) return true;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }


    }
}



?>