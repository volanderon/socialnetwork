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
            <div class="box-partial">All events</div>
            <div class="box-partial">Likes</div>
            <div class="box-partial">Comments</div>
            <div class="box-partial">Friendships</div>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>
        <?php require_once 'partials/friend-requests-box.tpl.php'; ?>

    </div>

</div>

<?php require_once 'partials/footer.tpl.php'; ?>