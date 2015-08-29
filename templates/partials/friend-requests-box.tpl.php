<?php if ($friendRequests): ?>
    <div class="clear-fix box">
        <div class="box-title">
            Friend Requests
        </div>
        <?php foreach($friendRequests as $friend): ?>
            <a href="profile.php?user_id=<?php echo $friend['user_id']; ?>">
                <img class="friend-pic" title="<?php echo $friend['user_firstname']; ?>" src="user_content/photos/<?php echo $friend['user_profile_picture']; ?>">
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>