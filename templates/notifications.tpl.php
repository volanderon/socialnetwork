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
            <div class="box-partial filter" data-type="all"><span class="f-allEvents">All events</span></div>
            <div class="box-partial filter" data-type="likes"><span class="f-likes">Likes</span></div>
            <div class="box-partial filter" data-type="comments"><span class="f-comments">Comments</span></div>
            <div class="box-partial filter" data-type="friendships"><span class="f-friendships">Friendships</span></div>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>
        <?php require_once 'partials/friend-requests-box.tpl.php'; ?>

    </div>

</div>

<?php require_once 'partials/footer.tpl.php'; ?>