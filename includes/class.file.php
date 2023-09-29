<?php 
  session_start();
  include 'dbh.config.php';
  class File extends Database {
    private $update = "latestupdate";
    private $notice = "noticeboard";
    private $gallery = "galleryimg";
    private $slider = "sliderimg";
	private $adm = "admission";
    private $conn = "";
        public function upload_LatestLinks($linktext,$file) {
            if(is_array($file)) {
                $conn = $this->connect();
                $folder_path = '../updatesuploads/';
                $filename = basename($file['name']);
                $filename = str_replace(' ', '_', $filename);
                $newstr  = $folder_path . $filename;
                if ($file['type'] == "application/pdf") {
                            
                            if (move_uploaded_file($file['tmp_name'], $newstr))
                            {

                                $filesql = "INSERT INTO $this->update (filename,link) VALUES('$linktext','$filename')";
                                $result1 = $conn->query($filesql);
                                if($result1){
                                    return true;
                                }else {
                                    return false;
                                } 
                            }
                            else
                            {
                                return false;
                            }

                                                        
                 } else {
                    return false;
                 }
            }else {
                return false;
            }

        }
        public function upload_noticeboard($text,$file) {
            if(is_array($file)) {
                $conn = $this->connect();
                $folder_path = '../noticeuploads/';
                $filename = basename($file['name']);
                $filename = str_replace(' ', '_', $filename);
                $newstr  = $folder_path . $filename;
                if ($file['type'] == "application/pdf") {
                            
                            if (move_uploaded_file($file['tmp_name'], $newstr))
                            {

                                $filesql = "INSERT INTO $this->notice (filename,link) VALUES('$text','$filename')";
                                $result = $conn->query($filesql);
                                if($result){
                                    return true;
                                }else {
                                    return false;
                                } 
                            }
                            else
                            {
                                return false;
                            }

                                                        
                 } else {
                    return false;
                 }
            }else {
                return false;
            }
        }

        public function upload_galleryimg($file) {
            if(is_array($file)) {
                $conn = $this->connect();
                $folder_path = '../galleryimg/';
                $filename = basename($file['name']);
                $filename = str_replace(' ', '_', $filename);
                $newstr  = $folder_path . $filename;
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
                if (in_array($file['type'], $allowed)) {
                            
                            if (move_uploaded_file($file['tmp_name'], $newstr)){
                                $filesql = "INSERT INTO $this->gallery (imglink) VALUES('$filename')";
                                $result = $conn->query($filesql);
                                if($result){
                                    return true;
                                }else {
                                    return false;
                                } 
                            }
                            else
                            {
                                return false;
                            }

                                                        
                 } else {
                    return false;
                 }
            }else {
                return false;
            }

        }
        public function upload_sliderimg($file) {
            if(is_array($file)) {
                $conn = $this->connect();
                $folder_path = '../sliderimg/';
                $filename = basename($file['name']);
                $filename = str_replace(' ', '_', $filename);
                $newstr  = $folder_path . $filename;
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
                if (in_array($file['type'], $allowed)) {
                            
                            if (move_uploaded_file($file['tmp_name'], $newstr)){
                                $filesql = "INSERT INTO $this->slider (imglink) VALUES('$filename')";
                                $result = $conn->query($filesql);
                                if($result){
                                    return true;
                                }else {
                                    return false;
                                } 
                            }
                            else
                            {
                                return false;
                            }

                                                        
                 } else {
                    return false;
                 }
            }else {
                return false;
            }

        }
        public function get_latestLinks(){
            $conn = $this->connect();
            $dir = "updatesuploads/";
			$sql="SELECT * FROM $this->update ORDER BY ID DESC";
            $result = $conn->query($sql);
            $count = 0;
            $img = "<img src='assets/img/new.gif'>";
			while($data = $result->fetch_assoc()){
                $count++;
                if($count < 4){
                    echo $img;
                }
                echo " ";
                echo "<a target='_blank' href='".$dir.$data['link']."'>".$data['filename']."</a>";
                echo " | ";
			}
        }
        public function get_noticeLinks(){
            $conn = $this->connect();
            $dir = "noticeuploads/";   
			$sql="SELECT * FROM $this->notice ORDER BY ID DESC";
            $result = $conn->query($sql);
            $count = 0;
            $img = "<img src='assets/img/new.gif'>";
			while($data = $result->fetch_assoc()){
                $count++;
				echo "<li><i class='fa fa-angle-right'></i> <a target='_blank' href='".$dir.$data['link']."'>".$data['filename']."</a>";
                if($count < 4){
                    echo " ";
                    echo $img;
                }
                echo "</li>";
			}
        }
        public function get_galleryImages(){
            $conn = $this->connect();
            $dir = "galleryimg/";
            $sql="SELECT * FROM $this->gallery ORDER BY ID DESC";
            $result = $conn->query($sql);
            $count = 0;
            
            while($data = $result->fetch_assoc()){
                if (file_exists($dir.$data['imglink'])) {
                    $count++;
                    echo "<a target='_blank' href='".$dir.$data['imglink']."'>
                      <img src='".$dir.$data['imglink']."'>
                    </a>";
                    if($count == 3){
                        echo "<div class='clear'></div>";
                        $count = 0;
                    }
                }
               
            }
        }
        public function get_indexImages(){
            $conn = $this->connect();
            $dir = "galleryimg/";
            $sql="SELECT * FROM $this->gallery ORDER BY ID DESC LIMIT 10";
            $result = $conn->query($sql);
            while($data = $result->fetch_assoc()){
                $link=$dir.$data['imglink'];
                if (file_exists($link)) {
                    echo "<div class='swiper-slide'>
                                <a target='_blank' href='".$link."'>
                                    <div class='image' style='background-image: url(".$link.");'>
                                        <div class='overlay'>
                                            <em class='mdi mdi-magnify-plus'></em>
                                        </div>
                                    </div>
                                </a>
                            </div>";
                }
               
            }
        }
        public function get_indexSliderImg(){
            $conn = $this->connect();
            $dir = "sliderimg/";
            $sql="SELECT * FROM $this->slider ORDER BY ID DESC";
            $result = $conn->query($sql);
            $active="1";
            while($data = $result->fetch_assoc()){
                $link=$dir.$data['imglink'];
                if (file_exists($link)) {
                    if ($active == 1) {
                         echo "<div class='carousel-item mh-250 active'>
                              <img class='d-block w-100 h-220' src='".$link."'>
                            </div>";
                            $active=0;
                    } else {
                        echo "<div class='carousel-item mh-250'>
                              <img class='d-block w-100 h-220' src='".$link."'>
                            </div>";
                    }
                }
               
            }
        }
        public function get_LatestTable(){
			$conn = $this->connect();
			$sql="SELECT * FROM $this->update ORDER BY ID DESC";
            $result = $conn->query($sql);
            $count = 0;
			while($data = $result->fetch_assoc()){
                $count++;
				echo "<tr>";
									echo "<th scope='row'>".$count."</th>";
									echo "<td>".$data['filename']."</td>";
									echo "<td>".$data['date']."</td>";
									echo "<td><a class='btn btn-danger' href='includes/deletelatest.php?id=".$data['id']."'>Delete</a></td>";
									echo "</tr>";
			}
        }
        
        public function get_noticeTable(){
			$conn = $this->connect();
			$sql="SELECT * FROM $this->notice ORDER BY ID DESC";
            $result = $conn->query($sql);
            $count = 0;
			while($data = $result->fetch_assoc()){
                $count++;
				echo "<tr>";
									echo "<th scope='row'>".$count."</th>";
									echo "<td>".$data['filename']."</td>";
									echo "<td>".$data['date']."</td>";
									echo "<td><a class='btn btn-danger' href='includes/deletenotice.php?id=".$data['id']."'>Delete</a></td>";
									echo "</tr>";
			}
		}
        public function get_gallery(){
            $conn = $this->connect();
            $sql="SELECT * FROM $this->gallery ORDER BY ID DESC";
            $result = $conn->query($sql);
            $count = 0;
            while($data = $result->fetch_assoc()){
                $count++;
                echo "<tr>";
                                    echo "<th scope='row'>".$count."</th>";
                                    echo "<td>".$data['imglink']."</td>";
                                    echo "<td>".$data['date']."</td>";
                                    echo "<td><a class='btn btn-danger' href='includes/deletegallery.php?id=".$data['id']."'>Delete</a></td>";
                                    echo "</tr>";
            }
        }
        public function get_slider(){
            $conn = $this->connect();
            $sql="SELECT * FROM $this->slider ORDER BY ID DESC";
            $result = $conn->query($sql);
            $count = 0;
            while($data = $result->fetch_assoc()){
                $count++;
                echo "<tr>";
                                    echo "<th scope='row'>".$count."</th>";
                                    echo "<td>".$data['imglink']."</td>";
                                    echo "<td>".$data['date']."</td>";
                                    echo "<td><a class='btn btn-danger' href='includes/deleteslider.php?id=".$data['id']."'>Delete</a></td>";
                                    echo "</tr>";
            }
        }
        public function del_latest($id) {
            $conn = $this->connect();
            $filesql = "SELECT link FROM $this->update WHERE id='$id'";
            $result = $conn->query($filesql);
            $data = $result->fetch_assoc();
            $data=$data['link'];    
            $dir = "../updatesuploads/";    
            $dirHandle = opendir($dir);    
        while ($file = readdir($dirHandle)) {    
            if($file==$data) {
                unlink($dir.$file);
            }
        }    
        closedir($dirHandle);
			$sql = "DELETE FROM $this->update WHERE id='$id'";
            $result = $conn->query($sql);
            if($result){
                return true;
            }else {
                return false;
            } 
        }


        public function del_notice($id) {
            $conn = $this->connect();
            $filesql = "SELECT link FROM $this->notice WHERE id='$id'";
            $result = $conn->query($filesql);
            $data = $result->fetch_assoc();
            $data=$data['link'];    
            $dir = "../noticeuploads/";    
            $dirHandle = opendir($dir);    
        while ($file = readdir($dirHandle)) {    
            if($file==$data) {
                unlink($dir.$file);
            }
        }    
        closedir($dirHandle);
			$sql = "DELETE FROM $this->notice WHERE id='$id'";
            $result = $conn->query($sql);
            if($result){
                return true;
            }else {
                return false;
            } 
        }
        public function del_gallery($id) {
            $conn = $this->connect();
            $filesql = "SELECT imglink FROM $this->gallery WHERE id='$id'";
            $result = $conn->query($filesql);
            $data = $result->fetch_assoc();
            $data=$data['imglink'];    
            $dir = "../galleryimg/";    
            $dirHandle = opendir($dir);    
        while ($file = readdir($dirHandle)) {    
            if($file==$data) {
                unlink($dir.$file);
            }
        }    
        closedir($dirHandle);
            $sql = "DELETE FROM $this->gallery WHERE id='$id'";
            $result = $conn->query($sql);
            if($result){
                return true;
            }else {
                return false;
            } 
        }

        public function del_slider($id) {
            $conn = $this->connect();
            $filesql = "SELECT imglink FROM $this->slider WHERE id='$id'";
            $result = $conn->query($filesql);
            $data = $result->fetch_assoc();
            $data=$data['imglink'];    
            $dir = "../sliderimg/";    
            $dirHandle = opendir($dir);    
        while ($file = readdir($dirHandle)) {    
            if($file==$data) {
                unlink($dir.$file);
            }
        }    
        closedir($dirHandle);
            $sql = "DELETE FROM $this->slider WHERE id='$id'";
            $result = $conn->query($sql);
            if($result){
                return true;
            }else {
                return false;
            } 
        }
	   // admission
         public function freeAdmissionForm($name,$fname,$dob,$course,$contactNo,$address,$qualification,$yearPass,$regType) {
        $conn = $this->connect();
        $filesql = "INSERT INTO $this->adm (name,fatherName,dob,course,contactNo,address,qualification,yearOfPassing,regType) VALUES('$name','$fname','$dob','$course','$contactNo','$address','$qualification','$yearPass','$regType')";
                            $result1 = $conn->query($filesql);
                            if($result1){
                                return true;
                            }else {
                                return false;
                            } 
    }
        public function paidAdmissionForm($name,$fname,$dob,$course,$contactNo,$address,$qualification,$yearPass,$regType,$transaction,$BankTransDate,$file) {
            if(is_array($file)) {
                $conn = $this->connect();
                $folder_path = '../bankSlips/';
                $filename = basename($file['name']);
                $rename =$name . uniqid() . $filename;
                $filename = str_replace(' ', '_', $rename);
                $newstr  = $folder_path . $filename;
                if (($file['type'] == "image/jpg") || ($file['type'] == "image/png") || ($file['type'] == "image/jpeg")) {
                            
                            if (move_uploaded_file($file['tmp_name'], $newstr))
                            {

                                $filesql = "INSERT INTO $this->adm (name,fatherName,dob,course,contactNo,address,qualification,yearOfPassing,regType,bankTransId,bankTransDate,bankSlip) VALUES('$name','$fname','$dob','$course','$contactNo','$address','$qualification','$yearPass','$regType','$transaction','$BankTransDate','$filename')";
                                $result1 = $conn->query($filesql);
                                if($result1){
                                    return true;
                                }else {
                                    return false;
                                } 
                            }
                            else
                            {
                                return false;
                            }

                                                        
                 } else {
                    return false;
                 }
            }else {
                return false;
            }

        }
        public function get_records(){
            $array = array();
			$conn = $this->connect();
			$sql="SELECT * FROM $this->adm";
            $result = $conn->query($sql);
            if($result) {
                while($data = $result->fetch_assoc()){
                    array_push($array,$data);	
                }
                return $array;
            } else {
                return 0;
            }
			
        }

  }
?>