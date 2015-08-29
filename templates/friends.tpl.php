<?php require_once 'partials/header.tpl.php'; ?>

<div id="friends-page" class="clear-fix">
    <?php require_once 'partials/profile-cover.tpl.php'; ?>

    <div id="left-section">
        <?php foreach ($friendsAll as $friend): ?>
            <div class="box align-vertical clear-fix" data-friend-id="<?php echo $friend['user_id']; ?>">
                <a href="profile.php?user_id=<?php echo $friend['user_id']; ?>">
                    <img class="user-welcome-pic" src="user_content/photos/<?php echo $friend['user_profile_picture']; ?>">
                    <span class="bold user-link"><?php echo $friend['user_firstname'] . ' ' . $friend['user_lastname']; ?></span>
                </a>
                <?php if ($page['is_me']): ?>
                    <div class="pca-icon remove-friend-icon"></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="right-section">
        <?php require_once 'partials/about-box.tpl.php'; ?>
        <?php require_once 'partials/friends-box.tpl.php'; ?>
        <?php if ($page['is_me']) { require_once 'partials/friend-requests-box.tpl.php'; } ?>
    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>