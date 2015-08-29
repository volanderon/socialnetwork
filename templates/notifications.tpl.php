<?php require_once 'partials/header.tpl.php'; ?>

<div id="notifications-page" class="clear-fix">
    <div id="left-section">

        <div id="notifications" class="box"></div>
        <input id="load-more-btn" type="button" value="Load More Notifications">

    </div>


    <div id="right-section">

        <?php require_once 'partials/welcome-box.tpl.php'; ?>

        <div class="box">
            <div class="box-title">Filter Events</div>
            <div class="box-partial filter" data-type="all">All events</div>
            <div class="box-partial filter" data-type="likes">Likes</div>
            <div class="box-partial filter" data-type="comments">Comments</div>
            <div class="box-partial filter" data-type="friendships">Friendships</div>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>
        <?php require_once 'partials/friend-requests-box.tpl.php'; ?>

    </div>

</div>

<?php require_once 'partials/footer.tpl.php'; ?>