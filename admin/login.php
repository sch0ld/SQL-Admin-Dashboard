<?php

//Includes config.php for easy database connection
include('../config.php');


// Redirects the user to dashboard.php if the user is logged in
if (isset($_SESSION['id'])) {
    header("Location: dashboard.php");
}


?>

<form action="login.php" method="post">
    <input type="text" name="email" placeholder="E-Mail">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="submit" value="Log in"> 
</form>


<?php


try 
{
    // Becomes True when the login button is pressed
    if (isset($_POST['submit'])) 
    {
        // include('../config.php');
        $email = $_POST['email'];
        //echo "Logins to: " . $email;
        $sql = "SELECT password,id,role FROM users WHERE email='$email'";

        $result = $conn->query($sql);

        $row = mysqli_fetch_assoc($result);
        $password = $row["password"];
        $id = $row['id'];
        $role = $row['role'];

        if ($password == $_POST['password']) 
        {
            $_SESSION['id'] = $id;
            
            if (strtolower($role) == "admin" || strtolower($role) == "developer" || strtolower($role) == "superadmin")
                header("Location: ../admin/dashboard.php");
            else 
                header("Location: ../index.php");
        }
        else 
            echo("Wrong pass!");
        
} 
}catch(Exception $ex) {
    echo "Wrong pass!";
}









?>

