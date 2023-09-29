<?php
session_start();
include 'dbh.config.php';
class User  extends Database{
    private $table = "admin";
    private $conn = "";
    public function reg_user($name,$email,$password) {
       $conn = $this->connect();
       $password = md5($password);
       $sql="SELECT * FROM $this->table WHERE email='$email'";
       $check = $conn->query($sql);
       $count_row = $check->num_rows;
       if ($count_row != 1){
           $sql="INSERT INTO $this->table (name, email, password) VALUES ('$name','$email','$password')";
           $result = $conn->query($sql);
           return $result;
       }
       else {
           return false;
        }
    }
    public function admin_login($emailid, $password){
       $conn = $this->connect();
       $email = mysqli_real_escape_string($conn, $emailid);
       $passw = mysqli_real_escape_string($conn, $password);
       $password = md5($passw);
       $sql="SELECT * from $this->table WHERE email = '$emailid' AND password = '$password'";
       $result    = $conn->query($sql);
       $data = $result->fetch_assoc();
       $count_row = $result->num_rows;
       if ($count_row == 1) {
               $_SESSION['admin_data'] = array(
                   "id"      => $data['id'],
                   "name"    => $data['name'],
                   "email"   => $data['email']
               );
               return true;
       }	else{
                return false;
       }
   }

   public function admin_logout() {
        session_unset();
        session_destroy();
        header("location: index.php");
        exit();
    }
 }
?>