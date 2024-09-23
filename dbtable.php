<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname = 'project';
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }
    else{
        echo"Connected<br>";
    }
    $sql ="CREATE TABLE PRO(
        CID INT PRIMARY KEY auto_increment,
        Username VARCHAR(30) NOT NULL,
        Email VARCHAR(50) NOT NULL,
        Password VARCHAR(50) NOT NULL,
        Cpassword VARCHAR(50) NOT NULL,
        Gender VARCHAR(50) NOT NULL,
        User_type VARCHAR(20))";
        if(mysqli_query($conn,$sql)){
            echo "table created successfully";
        }else{
            echo "Error in creation of table";
        }
        mysqli_close($conn);
?>