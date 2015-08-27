<?php require_once 'partials/header.tpl.php'; ?>

<div id="home-page">
    <div id="left-section">

        <div class="box update-status">

            <div class="box-title">
                <img class="box-user-icon" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
                <span class="user-firstName"><?php echo $_SESSION['auth']['user_firstname']; ?>, Update your status</span>
            </div>

            <textarea class="post-content" placeholder="What's on your mind?"></textarea>

            <div class="post-status">
                <input type="submit" name="post" value="Post">
            </div>

        </div>

        <div class="box post">

        </div>

    </div>

    <div id="right-section">

        <div class="box">
            <div class="box-title">Welcome</div>
            <a href="profile.php?user_id=<?php echo $_SESSION['auth']['user_id']; ?>">
                <img class="user-welcome-pic" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
            </a>
            <div class="details">
                <a href="profile.php?user_id=<?php echo $_SESSION['auth']['user_id']; ?>">
                    <span class="user-firstName"><?php echo $_SESSION['auth']['user_firstname']; ?></span>
                </a>
                <br>
                <a href="account.php">Edit Profile</a>
            </div>
        </div>

        <div class="box">
            <div class="box-title">My Details</div>
            <div class="details bold">
                <span class="user-fullName"><?php echo $_SESSION['auth']['user_firstname'] . ' ' . $_SESSION['auth']['user_lastname']; ?></span><br>
                <span class="user-birthDate"><?php echo $_SESSION['auth']['user_birthdate_hebrew'] ?></span>
                <span class="user-age">(<?php echo $_SESSION['auth']['age'] ?>)</span><br>
                <span class="user-email"><?php echo $_SESSION['auth']['user_email']; ?></span><br>
            </div>
        </div>

        <div class="clear-fix box">
            <div class="box-title"><a href="friends.php">My Friends</a> (<?php echo $friends['count']; ?>)</div>
            <?php foreach($friends['friends'] as $friend): ?>
                <a href="profile.php?user_id=<?php echo $friend['user_id']; ?>">
                    <img class="friend-pic" title="<?php echo $friend['user_firstname']; ?>" src="user_content/photos/<?php echo $friend['user_profile_picture']; ?>">
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>