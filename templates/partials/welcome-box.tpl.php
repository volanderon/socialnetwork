<div class="clear-fix box">
    <div class="box-title">Welcome</div>
    <a href="profile.php?user_id=<?php echo $_SESSION['auth']['user_id']; ?>">
        <img class="user-welcome-pic" src="<?php echo get_profile_picture($_SESSION['auth']['user_profile_picture']); ?>">
    </a>
    <div class="details">
        <a href="profile.php?user_id=<?php echo $_SESSION['auth']['user_id']; ?>">
            <span class="user-firstName"><?php echo $_SESSION['auth']['user_firstname']; ?></span>
        </a>
        <br>
        <a href="account.php">Edit Profile</a>
    </div>
</div>