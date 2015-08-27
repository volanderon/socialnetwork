<!DOCTYPE HTML>

<html>

<head>

    <link rel="stylesheet" href="css/basis.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/account.css">
    <script src="script/jquery-2.1.4.min.js"></script>
    <script src="script/utils.js"></script>
    <script src="script/account.js"></script>
    <script src="script/home.js"></script>
    <script src="script/index.js"></script>
    <script src="script/my_photos.js"></script>
    <script src="script/notifications.js"></script>
    <script src="script/post.js"></script>
    <script src="script/profile.js"></script>

</head>

<body>

    <div id="header-wrapper">
        <header>

            <div class="logo"><a href="home.php"></a></div>
            <div class="header-menu">
                <a href="profile.php?user_id=<?php echo $_SESSION['auth']['user_id']; ?>">
                    <span class="header-user-name"><?php echo $_SESSION['auth']['user_firstname']; ?></span>
                    <img class="header-user-icon" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
                </a>
                <a title="Home" href="home.php"><div class="header-notification-icon"></div></a>
                <a title="Edit Profile" href="account.php"><div class="header-account-icon"></div></a>
                <a title="Notifications" href="notifications.php"><div class="header-home-icon"></div></a>
                <a title="Logout" id="logout" href="#"><div class="header-logout-icon"></div></a>
            </div>

        </header>
    </div>


    <div id="wrapper">
        <div id="inner-wrapper">