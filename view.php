<?php
include "index.php";
include "token.php";
$sql="SELECT * FROM crud";
$result=$conn->query($sql);
?>
<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>

<body>

    <div class="container">

        <h2>users</h2>

<table class="table">

    <thead>

        <tr>

        <th>ID</th>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Email</th>

        <th>Gender</th>

        <th>Action</th>

    </tr>

    </thead>

    <tbody> 

        <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

        ?>

                    <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['firstname']; ?></td>

                    <td><?php echo $row['lastname']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td><?php echo $row['gender']; ?></td>

                    <td><a class="btn btn-info" href="update.php?token=<?php echo $_SESSION['token'] ?>">Edit</a> &nbsp; <a class="btn btn-danger" href="delete.php?token=<?php echo $_SESSION['token'] ?>">Delete</a></td>

                    </tr>                       

        <?php       }

            }

        ?>                

    </tbody>

</table>

    </div> 
    <center>
    <a class="btn btn-info" href="welcome.php">Insert new User</a>
        </center>
    <hr>
</body>

</html>