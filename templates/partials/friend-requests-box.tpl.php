<?php if ($friendRequests): ?>
    <div class="clear-fix box">
        <div class="box-title">
            Friend Requests
        </div>
        <?php foreach($friendRequests as $friend): ?>
            <a href="profile.php?user_id=<?php echo $friend['user_id']; ?>">
                <img class="friend-pic" title="<?php echo $friend['user_firstname']; ?>" src="<?php echo get_profile_picture($friend['user_profile_picture']); ?>">
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>