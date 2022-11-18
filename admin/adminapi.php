<?php

// Redirects the user to login.php if the user isn't logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}


if (isset($_POST['q'])) {
    if ($_POST['q'] == "editpass") {
        EditPassword($_POST['old'], $_POST['new'], $_POST['c_new']);
    }
}



function EditPassword($old, $new, $newC) {
    include('../config.php');
    $oldPass = $_POST['old'];
    $newPass = $_POST['new'];
    $cNewPass = $_POST['c_new'];
    
    // echo($oldPass . "|" . $newPass . "|" . $cNewPass . "|");
    
    $sql = "SELECT password,id FROM users WHERE id=" . $_SESSION['id'];
    $result = $conn->query($sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $currentPass = $row['password'];
    }
    
    echo $currentPass . "<br>";
    
    
    if (!empty($old)) {
        if ($old != $new) {
            if (!empty($new)) {
                if ($old == $currentPass && $newC == $new) {
                    echo "Both are same!";
                 
                    //  Edit the password in DB
                
                    // $sql = "SELECT password,id FROM admin WHERE id=" . ;
                
                
                    $sql = "UPDATE users SET password = '" . $new . "' WHERE id=" . $_SESSION['id'];
                    $result = $conn->query($sql);
                    header("location:profile.php?r=100");
                    
                
                
                }
                else
                header("location:profile.php?r=101");
            }
            else {
                header("location:profile.php?r=104");
            }
            
        }
        else {
            header("location:profile.php?r=103");
        }
        
    }
    else {
        header("location:profile.php?r=102");
    }


    
    
    
}


?>