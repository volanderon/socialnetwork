<?php require_once 'partials/header.tpl.php'; ?>

<div id="post-page" class="clear-fix">
    <div id="left-section">
        <div id="posts" class="no-delete" data-post-id="<?php echo (int)$_GET['post_id']; ?>"></div>
    </div>

    <div id="right-section">
        <?php require_once 'partials/welcome-box.tpl.php'; ?>
        <?php require_once 'partials/my-details-box.tpl.php'; ?>
        <?php require_once 'partials/friends-box.tpl.php'; ?>
    </div>

</div>

<?php require_once 'partials/footer.tpl.php'; ?>