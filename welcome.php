<?php
include "index.php";
if(isset($_POST['submit']))
{
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];

    $sql="INSERT INTO `crud`(`firstname`,`lastname`,`password`,`email`,`gender`) VALUES ('$firstname','$lastname','$password','$email','$gender')";

    $result=$conn->query($sql);
    
    if($result==TRUE)
    {
        header("Location:view.php");
        echo "new records created successfully";
    }
    else
    {
        echo "Error..".$sql."<br>".$conn->error;
    }
    $conn->close(); 
}
  

?>

<!DOCTYPE html>

<html>

<head>

  <link rel="stylesheet" href="welcome.css">

</head>

<body>


<form action="" method="POST">

<h2>User Details</h2>

    <legend>Personal information:</legend>

    <br>

    First name:<br>

    <input type="text" name="firstname" required>

    <br>

    Last name:<br>

    <input type="text" name="lastname" required>

    <br>
    Password:<br>

    <input type="password" name="password" required>

    <br>

    Email:<br>

    <input type="email" name="email" required>

    <br>

   
    Gender:<br>

    <br>

    <input type="radio" name="gender" value="Male">Male

    <input type="radio" name="gender" value="Female">Female

    <br><br>

    <input type="submit" name="submit" value="Submit">

    <br><br>

    <div class="logout">

      <a href="login.html" type="submit" >Logout</a>

    </div>

</form>

</body>

</html>