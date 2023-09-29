<?php
session_start();
include 'dbh.config.php';
class File extends Database {
    private $adm = "admission";
    private $conn = "";

    public function exportData(){
        $conn = $this->connect();
        $sql="SELECT `id`, `name`, `fatherName`, `dob`, `course`, `contactNo`, `address`, `qualification`, `yearOfPassing`,`regType`, `bankTransId`, `bankTransDate`,`bankSlip` FROM $this->adm";
        $result = $conn->query($sql);
        if ($result) {
            $count = 0;
            echo "<table>
                    <tr>
                        <td> <b>Sr. NO.</b> </td>
                        <td> <b>Name</b> </td>
                        <td> <b>Father Name</b> </td>
                        <td> <b>DOB</b> </td>
                        <td> <b>Course</b> </td>
                        <td> <b>Ph. No.</b> </td>
                        <td><b> Address</b> </td>
                        <td> <b>% of Marks</b> </td>
                        <td><b> Year of Passing</b> </td>
                        <td> <b>Reg. Type</b> </td>
                        <td> <b>Bank Transaction ID </b></td>
                        <td><b> Bank Transaction Date </b></td>
                        <td><b> Bank Slip Name </b></td>
                    </tr>";
            while($data = $result->fetch_assoc()){
                $count++;
                echo "<tr>
                        <td> ".$count." </td>
                        <td> ".$data['name']." </td>
                        <td> ".$data['fatherName']." </td>
                        <td> ".date("d-m-Y", strtotime($data['dob']))." </td>
                        <td> ".$data['course']." </td>
                        <td> ".$data['contactNo']." </td>
                        <td> ".$data['address']." </td>
                        <td> ".$data['qualification']." </td>
                        <td> ".$data['yearOfPassing']." </td>
                        <td> ".$data['regType']." </td>
                        <td> ".$data['bankTransId']." </td>";
                        echo ($data['bankTransDate'] == 0000-00-00) ? " " : "<td> ".$data['bankTransDate']." </td>";
                       echo "<td> ".$data['bankSlip']." </td>
                    </tr>";
            }
            echo "</table>";
            header("Content-Type: application/xls");    
            header("Content-Disposition: attachment; filename=admissionRecords.xls");  
            return true;
        } else {
            return false;
        }
    }
}
?>