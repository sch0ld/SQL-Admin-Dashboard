<?php
//Includes config.php for easy database connection
include('../config.php');

include('codes.php');


// Redirects the user to login.php if the user isn't logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}


?>
<?php

if (isset($_GET['q'])) {
    $sql = "SELECT * FROM users WHERE id=" . $_GET['q'];
}
else {
    // $sql = "INSERT INTO admin (company_mail, firstname, lastname, hiredSince, profilepictureurl) VALUES ('test@test.com', 'firstname', 'lastname', '2022-02-02', 'https://www.example.com')";
    $sql = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
}


$result = $conn->query($sql);

while($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $email = $row["email"];
    $companyMail = $row["company_mail"];
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $hiredSince = $row["hiredSince"];
    $role = $row["role"];
    $currentPassword = $row["password"];
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/astyle.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <script src="https://kit.fontawesome.com/a890ddfd63.js" crossorigin="anonymous"></script>

    <title>ButterFly</title>
</head>
<body>
    <div class="left-row" id="controller">
        <div class="logo"><img src="../assets/images/admin.png" alt=""></div>
        <div class="item">
            <a href="dashboard.php">Dashboard</a>
        </div>
        <div class="item">
            <a href="users.php">Users</a>
        </div>
        <div class="item">
            <a href="#statistics">Statistics</a>
        </div>
        <div class="item">
            <a href="#reviews">Reviews</a>
        </div>
        <div class="breaker"></div>
        <div class="item current">
            <a href="profile.php">My Profile</a>
        </div>
        <div class="item">
            <a href="#settings">Settings</a>
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
        <div class="profile">
            <img src="<?php echo('../admin/profilepictures/' . $id . '.png'); ?>" alt="">
            <p>Name & Role:</p>
            <h1><?php echo $firstname . " " . $lastname . " - " . $role; ?></h1>
            <p>Company Email:</p>
            <h1 title="Click to compose a mail"><a href="mailto:<?php echo $companyMail; ?>"><?php echo $companyMail; ?></a></h1>
            <p>Private Email:</p>
            <h1 title="Click to compose a mail"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></h1>


            <p>Password:</p>
            <form action="adminapi.php" method="post">
                <input type="hidden" name="q" value="editpass"><i class="fa-solid fa-eye"></i>
                <input type="password" name="old" id="oldpass" placeholder="Old Password" value="<?php echo $currentPassword; ?>"><button type="button" onclick=ShowPass();>Show/Hide Password 👁</button>
                <input type="password" name="new" placeholder="New Password">
                <input type="password" name="c_new" placeholder="Confirm New Password">
                <input type="submit" value="Save password" name="submit">
            </form>


            <?php

                if (isset($_GET['r'])) {
                    
                    $messageCode = $codes[$_GET['r']];
                    $messageColor = $colors[$_GET['r']];
                    echo('<h4 style="color: ' . $messageColor . ';">' . $messageCode . '</h4>');
                }

            ?>
            
            <form action="../admin/upload.php" method="post" enctype="multipart/form-data">
                <input  type="text" name="id" value="<?php echo($id); ?>">
                <p>New Profile Picture:</p>
                <input type="file" name="profilepicture" id="pp">
                <input type="submit" value="Upload Profile Picture" name="submit">
            </form>


            
            
        </div>
    </div>

    <script>

    function ShowPass()  {
        const typeOfInput = document.getElementById('oldpass').type;
        console.log(typeOfInput);

        if (typeOfInput == "text")
            document.getElementById('oldpass').type = "password";
        else {
            document.getElementById('oldpass').type = "text";
        }
    }

    </script>

</body>
</html>