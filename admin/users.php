<?php

include('../config.php');

// Redirects the user to login.php if the user isn't logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

?>
<?php

// $sql = "INSERT INTO admin (company_mail, firstname, lastname, hiredSince, profilepictureurl) VALUES ('test@test.com', 'firstname', 'lastname', '2022-02-02', 'https://www.example.com')";
$sql = "SELECT * FROM users WHERE id=" . $_SESSION['id'];

$result = $conn->query($sql);

while($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $role = $row["role"];
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/astyle.css">
    <link rel="stylesheet" href="../assets/css/users.css">
    <title>ButterFly</title>
</head>
<script>

<?php

//echo "alert('" . $role. "');";

?>

</script>
<body>
    <div class="left-row" id="controller">
        <div class="logo"><img src="../assets/images/admin.png" alt=""></div>
        <div class="item">
            <a href="dashboard.php">Dashboard</a>
        </div>
        <div class="item current">
            <a href="users.php">Users</a>
        </div>
        <div class="item">
            <a href="#statistics.php">Statistics</a>
        </div>
        <div class="item">
            <a href="#reviews">Reviews</a>
        </div>
        <div class="breaker"></div>
        <div class="item">
            <a href="profile.php">My Profile</a>
        </div>
        <div class="item">
            <a href="#settings.php">Settings</a>
        </div>
        <div class="item">
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <div class="top-bar">
            <div class="profile-settings">
                <img src="<?php echo('../admin/profilepictures/' . $id . '.png'); ?>" alt="https://via.placeholder.com/150"><h1><?php echo $firstname . " " . $lastname;?></p>
                <p id="role"><?php echo $role; ?></p>
            </div>
        </div>
    <div class="body-content" id="content">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Registration Date</th>
                <th>Password</th>
                <th>Home Location</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
            </tr>
            <?php

    // $sql = "INSERT INTO admin (company_mail, firstname, lastname, hiredSince, profilepictureurl) VALUES ('test@test.com', 'firstname', 'lastname', '2022-02-02', 'https://www.example.com')";
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            if ($role == "SuperAdmin")
            echo "<tr onclick='javascript:location.assign(\"profile.php?q=" . $row["id"] . "\")';>";
            else
            echo "<tr>";
            echo'<td>' . $row["id"] . '</td>';
            echo'<td>' . $row['username'] . '</td>';
            echo'<td>' .$row['email'] .'</td>';
            echo'<td>' . $row["registration_date"] . '</td>';
            echo'<td>' . $row['password'] . '</td>';
            echo'<td>' .$row['home_location'] .'</td>';
            echo'<td>' . $row["dob"] . '</td>';
            echo'<td>' . $row['gender'] . '</td>';
            echo'<td>' .$row['firstname'] .'</td>';
            echo'<td>' .$row['lastname'] .'</td>';
            echo'<td>' .$row['role'] .'</td>';
            echo "</tr>";
        }
    }
    ?>
        </table>
    </div>

    <!-- <div class="add-user">
        <p>+</p>
    </div> -->
</body>
</html>