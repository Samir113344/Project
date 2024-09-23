<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="log.css">
</head>
<body>
    <div class="blue">
    <?php
session_start();
$erremail = $errpass = $error = "";

if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username1 = "root";
    $password1 = "";
    $dbname = 'project';
    $conn = mysqli_connect($servername, $username1, $password1, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check for photographer login credentials
    $sql_photographer = "SELECT * FROM PG WHERE email = '$email' AND password = '$password'";
    $res_photographer = mysqli_query($conn, $sql_photographer);
    $Numrows_photographer = mysqli_num_rows($res_photographer);

    // Check for user login credentials
    $sql_user = "SELECT * FROM pro WHERE email = '$email' AND password = '$password'";
    $res_user = mysqli_query($conn, $sql_user);
    $Numrows_user = mysqli_num_rows($res_user);

    // Check for admin login credentials
    $sql_admin = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $res_admin = mysqli_query($conn, $sql_admin);
    $Numrows_admin = mysqli_num_rows($res_admin);

    if ($Numrows_photographer == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = 'photographer';
        header('Location: alogin.php'); // Redirect to photographer page
        exit; // Terminate the script after redirect
    } elseif ($Numrows_user == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = 'user';
        header('Location: alogin.php'); // Redirect to user page
        exit; // Terminate the script after redirect
     } elseif ($Numrows_admin == 1) {
         $_SESSION['email'] = $email;
         $_SESSION['user_type'] = 'admin';
         header('Location: disp.php'); // Redirect to admin page
         exit; // Terminate the script after redirect
    } else {
        $error = "Log in failed";
    }
}
?>

        <form action="" method="post">
            <h2>LOGIN</h2>
            <?php if (!empty($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <label>Email</label>
            <input type="text" name="email" placeholder="Email"><br>

            <label>Password</label>
            <input type="password" name="password" placeholder="Password"><br>

            <label>User Type:</label>
            <select name="user_type">
                <option value="photographer">Photographer</option>
                <option value="user">User</option>
        
            </select>

            <input type="submit" name="Login">
        </form>
    </div>
</body>
</html>
