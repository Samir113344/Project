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
    $sql ="CREATE TABLE Image(
        ID INT PRIMARY KEY auto_increment,
        name VARCHAR(20) NOT NULL,
        email VARCHAR(30) NOT NULL,
        contact VARCHAR(10) NOT NULL,
        rate VARCHAR(10) NOT NULL,
        image_data LONGBLOB)";
        if(mysqli_query($conn,$sql)){
            echo "Table created successfully";
        }else{
            echo "Error in creation of table";
        }
        mysqli_close($conn);
?>