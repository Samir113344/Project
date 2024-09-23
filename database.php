<?php
$servername="localhost";
$username="root";
$password="";
$conn=mysqli_connect($servername,$username,$password);
$sql="CREATE DATABASE Project";
if(mysqli_query($conn,$sql)){
    echo "Database created successfully!";
}
else{
    echo "Error:Database creation failed";
}
mysqli_close($conn);
?>