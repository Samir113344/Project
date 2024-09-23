<?php
$servername="localhost";
$username1="root";
$password1="";
$dbname = 'bcathird';
$conn=mysqli_connect($servername,$username1,$password1,$dbname);
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
else{
    echo"Connected<br>";
}
$value = "INSERT INTO user(id,username,password) VALUES (2,'samir','samir');";
           // echo $value;  
    //echo $value;
    if(mysqli_query($conn,$value)){
        echo "success";
    }
    else{
        echo "error";
    }

?>