<?php require_once 'partials/header.tpl.php'; ?>

<div id="home-page" class="clear-fix">
    <div id="left-section">

        <div class="box update-status">

            <div class="box-title">
                <img class="box-user-icon" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
                <span class="user-firstName"><?php echo $_SESSION['auth']['user_firstname']; ?>, Update your status</span>
            </div>

            <textarea id="new-post-content" class="new-post-content" placeholder="What's on your mind?"></textarea>

            <div class="post-status">
                <input id="new-post-btn" type="submit" name="post" value="Post">
            </div>

        </div>

        <div id="posts"></div>

        <input id="load-more-posts-btn" type="button" value="Load More">

    </div>

    <div id="right-section">

        <?php require_once 'partials/welcome-box.tpl.php'; ?>

        <div class="clear-fix box">
            <div class="box-title">My Details</div>
            <div class="details bold">
                <span class="user-fullName"><?php echo $_SESSION['auth']['user_firstname'] . ' ' . $_SESSION['auth']['user_lastname']; ?></span><br>
                <span class="user-birthDate"><?php echo $_SESSION['auth']['user_birthdate_hebrew'] ?></span>
                <span class="user-age">(<?php echo $_SESSION['auth']['age'] ?>)</span><br>
                <span class="user-email"><?php echo $_SESSION['auth']['user_email']; ?></span><br>
            </div>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>

    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>