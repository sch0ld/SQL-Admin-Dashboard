<?php



//Includes config.php for easy database connection
include('../config.php');

// Redirects the user to login.php if the user isn't logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

?>
<?php


//Grabs everything from the logged in user using its ID in the database
$sql = "SELECT * FROM users WHERE id=" . $_SESSION['id'];


//Saves the info into $result variable
$result = $conn->query($sql);


//Goes through the result row by row and sets each column value to a variable
while($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $companyMail = $row["company_mail"];
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $hiredSince = $row["hiredSince"];
    $role = $row["role"];
}
?>

<?php

// $sql = "INSERT INTO admin (company_mail, firstname, lastname, hiredSince, profilepictureurl) VALUES ('test@test.com', 'firstname', 'lastname', '2022-02-02', 'https://www.example.com')";
$sql = "SELECT count('gender') AS TOTALCOUNT FROM users";
$sqlTest = "SELECT * FROM users WHERE gender='male'";

$result = $conn->query($sql);
$resultTest = $conn->query($sqlTest);

while($row = mysqli_fetch_assoc($result)) {
    // $gender = $row["gender"];
    $totalUsers = $row["TOTALCOUNT"];
}
$men = array();
while($row = mysqli_fetch_assoc($resultTest)) {
    $gender = $row["gender"];

    array_push($men, $gender);

}

$totalMen = count($men);
$totalWomen = $totalUsers - $totalMen;

$percentageMen = ($totalMen/$totalUsers)*100;
$percentageWomen = ($totalWomen/$totalUsers)*100;

$men = mb_strimwidth($percentageMen, 0, 4, "");
$women = mb_strimwidth($percentageWomen, 0, 4, "");
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/astyle.css">
    <title>ButterFly</title>
</head>
<body>
    <div class="left-row" id="controller">
        <div class="logo"><img src="../assets/images/admin.png" alt=""></div>
        <div class="item current">
            <a href="dashboard.php">Dashboard</a>
        </div>
        <div class="item">
            <a href="users.php">Users</a>
        </div>
        <div class="item">
            <a href="#statistics.php">Statistics</a>
        </div>
        <div class="item">
            <a href="#reviews.php">Reviews</a>
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
        <div class="_users">
            <div class="quick-stat total-users_stat">
                <img src="../assets/images/female_male.png" alt="">
            <h1 id="total-users"><?php echo $totalUsers . ""; ?></h1>
            </div>
            <div class="quick-stat gender_stat">
            <img src="../assets/images/male.png" alt="">
                <h1 id="male-users"><?php echo $men . "%";?></h1>
            </div>
            <div class="quick-stat gender_stat">
            <img src="../assets/images/female.png" alt="">
                <h1 id="female-users"><?php echo $women . "%"; ?></h1>
            </div>
            

        </div>
    </div>
</body>
</html>