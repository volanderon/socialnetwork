<?php require_once 'partials/header.tpl.php'; ?>

<div id="friends-page" class="clear-fix">
    <div id="profile-cover" class="box">
        <img src="user_content/covers/<?php echo $viewedUser['user_secret_picture']; ?>">
        <div class="pc-footer">
            <a href="profile.php?user_id=<?php echo $viewedUser['user_id']; ?>">
                <img src="user_content/photos/<?php echo $viewedUser['user_profile_picture']; ?>">
            </a>
            <?php echo $viewedUser['full_name']; ?>
        </div>
    </div>

    <div id="left-section">
        <?php foreach ($friendsAll as $friend): ?>
            <div class="box align-vertical clear-fix">
                <a href="profile.php?user_id=<?php echo $friend['user_id']; ?>">
                    <img class="user-welcome-pic" src="user_content/photos/<?php echo $friend['user_profile_picture']; ?>">
                    <span class="bold user-link"><?php echo $friend['user_firstname'] . ' ' . $friend['user_lastname']; ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="right-section">
        <?php require_once 'partials/about-box.tpl.php'; ?>
        <?php require_once 'partials/friends-box.tpl.php'; ?>
    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>