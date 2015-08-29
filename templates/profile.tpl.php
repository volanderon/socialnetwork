<?php require_once 'partials/header.tpl.php'; ?>

<div id="profile-page" class="clear-fix">
    <?php require_once 'partials/profile-cover.tpl.php'; ?>

    <div id="left-section">
        <?php require_once 'partials/posts.tpl.php'; ?>
    </div>

    <div id="right-section">

        <?php require_once 'partials/about-box.tpl.php'; ?>

        <div class="box">
            <div class="box-title">Filter</div>
            <div class="box-partial filter" data-type="by_me">Posts written by <?php echo $viewedUser['full_name']; ?></div>
            <div class="box-partial filter" data-type="all">All time</div>
            <?php foreach ($page['periods'] as $key => $period): ?>
                <div class="box-partial filter" data-type="<?php echo $key; ?>"><?php echo $period; ?></div>
            <?php endforeach; ?>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>
        <?php if ($page['is_me']) { require_once 'partials/friend-requests-box.tpl.php'; } ?>

    </div>
</div>

<?php require_once 'partials/footer.tpl.php'; ?>