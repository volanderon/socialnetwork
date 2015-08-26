<?php include_once 'inc/guard.php'; ?>
<?php include_once 'inc/header.php'; ?>

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
                <img class="user-welcome-pic" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
                <div class="details">
                    <span class="user-firstName"><?php echo $_SESSION['auth']['user_firstname']; ?></span><br>
                    <a href="account.php">Edit Profile</a>
                </div>
            </div>

            <div class="box">
                <div class="box-title">My Details</div>
                <div class="details bold">
                    <span class="user-fullName"><?php echo $_SESSION['auth']['user_firstname'] . ' ' . $_SESSION['auth']['user_lastname']; ?></span><br>
                    <span class="user-birthDate"><?php echo $_SESSION['auth']['user_birthdate'] ?></span>
                    <span class="user-age">([age])</span><br>
                    <span class="user-email"><?php echo $_SESSION['auth']['user_email']; ?></span><br>
                </div>
            </div>

            <div class="box">
                <div class="box-title">Me Friends</div>
                <img class="friend-pic" src="">
                <img class="friend-pic" src="">
                <img class="friend-pic" src="">
                <img class="friend-pic" src="">
                <img class="friend-pic" src="">
                <img class="friend-pic" src="">
            </div>

        </div>
    </div>


<?php include_once 'inc/footer.php'; ?>