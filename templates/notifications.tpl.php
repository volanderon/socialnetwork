<?php require_once 'partials/header.tpl.php'; ?>

<div id="notifications-page" class="clear-fix">
    <div id="left-section">

        <div class="box">

            <div class="box-subTitle clear-fix notification">
                <img class="user-welcome-pic" src="">
                <span class="box-text"><span class="user-link">[FullName]</span> added you as a friend.</span>
                <div id="noti-added">15 minutes ago</div>
            </div>

            <div class="box-subTitle clear-fix notification">
                <img class="user-welcome-pic" src="">
                <span class="box-text"><span class="user-link">[FullName]</span> commented on your <a href="">Post.</a></span>
                <div id="noti-commented">15 minutes ago</div>
            </div>

            <div class="box-subTitle clear-fix notification">
                <img class="user-welcome-pic" src="">
                <span class="box-text"><span class="user-link">[FullName]</span> liked your <a href="">Post.</a></span>
                <div id="noti-liked">15 minutes ago</div>
            </div>

        </div>

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