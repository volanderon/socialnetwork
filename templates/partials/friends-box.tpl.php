<div class="clear-fix box">
    <div class="box-title">
        <a href="friends.php"><?php echo isset($page['friends_box_title']) ? $page['friends_box_title'] : 'My Friends'; ?></a>
        (<?php echo $friends['count']; ?>)
    </div>
    <?php foreach($friends['friends'] as $friend): ?>
        <a href="profile.php?user_id=<?php echo $friend['user_id']; ?>">
            <img class="friend-pic" title="<?php echo $friend['user_firstname']; ?>" src="user_content/photos/<?php echo $friend['user_profile_picture']; ?>">
        </a>
    <?php endforeach; ?>
</div>