<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
<link rel="stylesheet" href="page.css">
</head>
<body>
<?php
$errname=$erremail=$errpass=$errcpass= $errsubmit=$genderErr="";
    if(isset($_POST['Signup'])){
        $name=$_POST['username'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        $cpassword=$_POST['cpassword']; 
        if(empty($name)){
            $errname="Username cannot be empty";
        }
        else{
            echo $name;
        }
        if(empty($password) || strlen($password)<=8){
            $errpass= "Password must be greater than 8 character";
        }
        else{
            echo"$password";
        }
        if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
            $erremail="Enter valid email";
        }
        else{
            echo "$email";
        }
        if(empty($password!==$cpassword)){
            $errcpass= "Password must be same";
        }
        else{
            echo"$cpassword";
        }
        $gender='';
        if(empty($_POST['gender'])){
            $genderErr = "Gender is required";
        }
        else{
            $gender = $_POST['gender'];
        }
        if(!isset($name) || !isset($password) || !isset($email) || !isset($cpassword)){
            $errsubmit ="Please fix above errors";
        }
    

    $servername="localhost";
    $username1="root";
    $password1="";
    $dbname = 'project';
    $conn=mysqli_connect($servername,$username1,$password1,$dbname);
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }
    else{
        // echo"Connected<br>";
    }
    
    //echo $password;
    $value = "INSERT INTO pro(Username,Email,Password,Cpassword,Gender) VALUES('$name','$email','$password','$cpassword','$gender')";
    //echo $value;
    mysqli_query($conn,$value);
    //     echo "Record saved successfully";
    // }else{
    //     echo"Error:Record cant be saved";
    // }
    header('Location: clogin.php');
}
?>
<div class ="green">
    <form method="post" action="">
        <h2>Signup<h2>
        <label for="name">Username:</label><input type="text" name="username" text placeholder="Enter your Name" id="name">
        <span class ="error"><?php echo $errname ?></span><br><br>
        <label for="email">Email:</label><input type="text" name="email" text placeholder="Enter your Email" id="email">
        <span class="error"><?php echo $erremail ?> </span><br><br>
        <label for="password">Password:</label><input type="password" name="password" text placeholder="Enter your Password" id="password">
        <span class="error"><?php echo$errpass?><br><br>
        <label for="cpassword">Confirm Password:</label><input type="password" name="cpassword" text placeholder="Enter Confirm Password" id="cpassword">
        <span class="error"><?php echo$errcpass?><br><br>
        <label for="gender">
            Gender:
            <input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Female">Female
        </label><br>    
        <span class="error"><?php echo$genderErr?></span>
        <input type="submit" name="Signup" >
        <span class="error"><?php echo$errsubmit?></span>
</div>
</body>
</html>