<div class="box update-status">

    <div class="box-title">
        <img class="box-user-icon" src="<?php echo get_profile_picture($_SESSION['auth']['user_profile_picture']); ?>">
        <span class="user-firstName"><?php echo $_SESSION['auth']['user_firstname']; ?>, Update your status</span>
    </div>

    <textarea id="new-post-content" class="new-post-content" placeholder="What's on your mind?"></textarea>

    <div class="post-status">
        <input id="new-post-btn" type="submit" name="post" value="Post">
    </div>

</div>

<div id="posts"></div>

<input id="load-more-btn" type="button" value="Load More">