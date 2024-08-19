<?php
// Defining constants
define("PROFILE_PICTURE", "./images/profile_picture.png");
define("FULL_NAME", "Gilbert Ozioma");
define("PROFESSION", "Full-stack Developer");

// Defining variables
$location = "Abuja, Nigeria";
$email = "gilbertozioma0@gmail.com";
$phone = "+234 9075 388 644";
$bio = "I am a certified full-stack web developer specializing in backend development using Laravel and MySQL database. Currently, I am expanding my skills by learning full-stack development using Laravel with Vue.";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <h1><?php echo FULL_NAME; ?>'s Profile</h1>

    <div class="profile-head">
        <img src="<?php echo PROFILE_PICTURE; ?>" alt="Profile Picture">
        <p class="pp">Profile picture</p>
        <label>Bio</label>
        <p><?php echo $bio; ?></p>

    </div>

    <!-- <hr> -->

    <div class="profile-info">
        <label>Full Name</label>
        <p><?php echo FULL_NAME; ?></p>
    </div>

    <div class="profile-info">
        <label>Profession</label>
        <p><?php echo PROFESSION; ?></p>
    </div>

    <div class="profile-info">
        <label>Location</label>
        <p><?php echo $location; ?></p>
    </div>

    <div class="profile-info">
        <label>Email</label>
        <p><?php echo $email; ?></p>
    </div>

    <div class="profile-info">
        <label>Phone</label>
        <p><?php echo $phone; ?></p>
    </div>

</body>

</html>