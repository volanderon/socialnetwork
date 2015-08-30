<div class="clear-fix box">
    <div class="box-title">
        <a class="bold user-link" href="friends.php?user_id=<?php echo !empty($viewedUser) ? $viewedUser['user_id'] : $_SESSION['auth']['user_id']; ?>">
            <?php echo isset($page['friends_box_title']) ? $page['friends_box_title'] : 'My Friends'; ?></a>
        (<?php echo $friends['count']; ?>)
    </div>
    <?php if (!$friends['friends']) { echo '<div class="box-partial">None yet</div>'; } ?>
    <?php foreach($friends['friends'] as $friend): ?>
        <div id="friend-img-wrapper">
            <span><?php echo $friend['user_firstname'].' '.$friend['user_lastname']; ?></span>
            <a href="profile.php?user_id=<?php echo $friend['user_id']; ?>">
                <img class="friend-pic" title="<?php echo $friend['user_firstname']; ?>" src="user_content/photos/<?php echo $friend['user_profile_picture']; ?>">
            </a>
        </div>
    <?php endforeach; ?>
</div>