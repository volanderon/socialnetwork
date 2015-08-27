<?php require_once 'partials/header.tpl.php'; ?>

<div id="notifications-page" class="clear-fix">
    <div id="left-section">

        <div class="box">

            aaa

        </div>

    </div>


    <div id="right-section">

        <?php require_once 'partials/welcome-box.tpl.php'; ?>

        <div class="box">
            <div class="box-title">Filter Events</div>
            <div class="box-subTitle">All events</div>
            <div class="box-subTitle">Likes</div>
            <div class="box-subTitle">Comments</div>
            <div class="box-subTitle">Friendships</div>
        </div>

        <?php require_once 'partials/friends-box.tpl.php'; ?>

        <div class="box">
            <div class="box-title">Friend Requests</div>
            <div>none</div>
        </div>

    </div>

</div>

<?php require_once 'partials/footer.tpl.php'; ?>