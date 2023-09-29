<?php
    class Database{
        private $host;
        private $username;
        private $password;
        private $database;

        protected function connect() {
           $this->host="localhost:3306";
           $this->username="";
           $this->password="";
           $this->database="";
            $conn = new mysqli($this->host,$this->username,$this->password,$this->database);
            return $conn;
        }
    }
?>