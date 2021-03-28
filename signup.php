<?php

require "includes/db_connect.inc.php";

$username = $password = $fName = $lName = $dob = $email = $mobile = $err = "";
$errExists = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username'])) {
        $err = "Username cannot be empty!";
        $errExits = true;
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
    }
    if (empty($_POST['password'])) {
        $err = "password cannot be empty!";
        $errExits = true;
    } else {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    }
    if (empty($_POST['fName'])) {
        $err = "fName cannot be empty!";
        $errExits = true;
    } else {
        $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    }
    if (empty($_POST['lName'])) {
        $err = "lName cannot be empty!";
        $errExits = true;
    } else {
        $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    }
    if (empty($_POST['dob'])) {
        $err = "dob cannot be empty!";
        $errExits = true;
    } else {
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    }
    if (empty($_POST['email'])) {
        $err = "email cannot be empty!";
        $errExits = true;
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    }
    if (empty($_POST['mobile'])) {
        $err = "mobile cannot be empty!";
        $errExits = true;
    } else {
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    }

    if (!$errExists) {
        $sqlUsers = "select username from user where username = '$username'";
        $results = mysqli_query($conn, $sqlUsers);

        $rowCount = mysqli_num_rows($results);
        if ($rowCount > 0) {
            $err = "User already exists!";
        } else {
            $sqlInsert = "insert into user (userName, fName, lName, password, dob, email, mobile)
				  values('$username', '$fName','$lName','$password', '$dob',  '$email', '$mobile');";

            mysqli_query($conn, $sqlInsert);
            //   header("Location: ./login.php");
            // echo '<alert>Registration successful</alert>';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>

<body>
    <h1>Signup</h1>

    <span style="color:red;"><?php echo $err; ?></span>

    <form name="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <p>Username</p>
        <input type="text" name="username" value="<?php echo $username; ?>"><br />
        <p>password</p>
        <input type="text" name="password" value="<?php echo $password; ?>"><br />
        <p>First name</p>
        <input type="text" name="fName" value="<?php echo $fName; ?>"><br />
        <p>Last name</p>
        <input type="text" name="lName" value="<?php echo $lName; ?>"><br />
        <p>DOB</p>
        <input type="date" name="dob" value="<?php echo $dob; ?>"><br />
        <p>Email</p>
        <input type="text" name="email" value="<?php echo $email; ?>"><br />
        <p>Mobile Number</p>
        <input type="text" name="mobile" value="<?php echo $mobile; ?>"><br />
        <input type="submit" name="" value="SignUp">
    </form>
</body>

</html>