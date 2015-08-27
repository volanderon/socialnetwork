<?php require_once 'partials/header.tpl.php'; ?>

<div id="profile-page" class="clear-fix">
    <div id="left-section">
        <?php require_once 'partials/posts.tpl.php'; ?>
    </div>

    <div id="right-section">

        <?php require_once 'partials/about-box.tpl.php'; ?>

        <div class="box">
            <div class="box-title">Filter</div>
            <div class="box-subTitle">Posts written by <?php echo $_SESSION['auth']['full_name']; ?></div>
            <div class="box-subTitle">All time</div>
            <div class="box-subTitle">[dynamic]</div>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>

    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>