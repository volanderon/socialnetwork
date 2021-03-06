<div id="profile-cover" class="box">
    <img src="<?php echo get_cover_picture($viewedUser['user_secret_picture']); ?>">
    <div class="pc-footer">
        <a href="profile.php?user_id=<?php echo $viewedUser['user_id']; ?>">
            <img src="<?php echo get_profile_picture($viewedUser['user_profile_picture']); ?>">
        </a>
        <?php echo $viewedUser['full_name']; ?>
        <?php if ($page['friend']['is_friend']): ?>
            <div class="pc-is-friend"></div>
        <?php endif; ?>
        <div class="pc-actions">
            <?php if ($page['is_me']): ?>
                <div class="pca-icon change-cover-icon"><a href="account.php#images"></a></div>
            <?php endif; ?>
            <?php if (!$page['is_me'] && !$page['friend']['is_friend'] && !$page['friend']['is_friend_req_sent']): ?>
                <div class="pca-icon add-friend-icon"></div>
            <?php endif; ?>
            <?php if (!$page['is_me'] && ($page['friend']['is_friend'] || $page['friend']['is_friend_req_sent'])): ?>
                <div class="pca-icon remove-friend-icon"></div>
            <?php endif; ?>
        </div>
    </div>
</div>