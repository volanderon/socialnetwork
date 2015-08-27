<?php require_once 'partials/header.tpl.php'; ?>

<div id="profile-page" class="clear-fix">
    <div id="profile-cover" class="box">
        <img src="user_content/covers/<?php echo $viewedUser['user_secret_picture']; ?>">
        <div class="pc-footer">
            <img src="user_content/photos/<?php echo $viewedUser['user_profile_picture']; ?>">
            <?php echo $viewedUser['full_name']; ?>
        </div>
    </div>

    <div id="left-section">
        <?php require_once 'partials/posts.tpl.php'; ?>
    </div>

    <div id="right-section">

        <?php require_once 'partials/about-box.tpl.php'; ?>

        <div class="box">
            <div class="box-title">Filter</div>
            <div class="box-subTitle">Posts written by <?php echo $viewedUser['full_name']; ?></div>
            <div class="box-subTitle">All time</div>
            <div class="box-subTitle">[dynamic]</div>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>

    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>