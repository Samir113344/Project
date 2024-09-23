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
    $sql ="CREATE TABLE ProfilePictures (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        type VARCHAR(100) NOT NULL,
        size INT NOT NULL,
        data LONGBLOB NOT NULL
    )";
        if(mysqli_query($conn,$sql)){
            echo "Table created successfully";
        }else{
            echo "Error in creation of table";
        }
        mysqli_close($conn);
?>