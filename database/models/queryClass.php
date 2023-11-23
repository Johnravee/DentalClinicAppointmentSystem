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
                $_SESSION['firstname'] = $row['firstName'];
                $_SESSION['surname'] = $row['surName'];
                
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
                $_SESSION['firstname'] = $row['firstName'];
                $_SESSION['surname'] = $row['surName'];
                
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
        $selectApprovedAppoinments = "SELECT * FROM appointments WHERE Statuss = 'Pending' ORDER BY datee ASC";
        $query = $this->db->query($selectApprovedAppoinments);
        $result = array();


        while($row = $query->fetch_assoc()){
            $result[] = $row;

        }
        return $result;
        
       
    } 

}




?>