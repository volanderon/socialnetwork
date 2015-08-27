<?php require_once 'partials/header.tpl.php'; ?>

<div id="friends-page" class="clear-fix">
    <div id="profile-cover" class="box">
        <img src="user_content/covers/<?php echo $viewedUser['user_secret_picture']; ?>">
        <div class="pc-footer">
            <img src="user_content/photos/<?php echo $viewedUser['user_profile_picture']; ?>">
            <?php echo $viewedUser['full_name']; ?>
        </div>
    </div>

    <div id="left-section">
        <?php foreach ($friendsAll as $friend): ?>
            <div class="box align-vertical clear-fix">
                <img class="user-welcome-pic" src="user_content/photos/<?php echo $friend['user_profile_picture']; ?>">
                <?php echo $friend['user_firstname'] . ' ' . $friend['user_lastname']; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="right-section">
        <?php require_once 'partials/about-box.tpl.php'; ?>
        <?php require_once 'partials/friends-box.tpl.php'; ?>
    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>