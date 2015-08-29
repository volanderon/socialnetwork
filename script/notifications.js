var Notifications = {
    offset: 0,
    /**
     * Get X notifications for current user
     */
    loadNotifications: function() {
        $.ajax({
            type: "GET",
            url: "api/notifications/" + Notifications.offset + "/10",
            success: function(notifications_list) {
                var len = notifications_list.length;
                $.each(notifications_list, function(key, notification) {
                    $('#notifications').append(Notifications.buildNotificationHtml(notification));
                });
                if (len) {
                    $('#notifications .notification').slice(-(Math.min(10, len))).hide().slideDown();
                } else {
                    $('#load-more-btn').remove();
                }
            }
        });
        Notifications.offset += 10;
    },
    /**
     * Build the notification html depending on the event type
     * Like to users and posts
     * @param notification
     * @returns {string}
     */
    buildNotificationHtml: function(notification) {
        var text = '', className = '',
            full_name = '<a class="user-link" href="profile.php?user_id=' + notification.friend_id + '">' + notification.full_name + '</a>',
            post = '<a href="post.php?post_id=' + notification.post_id + '">post</a>';
        switch (notification.type) {
            case 'request_sent':
                text = full_name + ' added you as a friend.';
                className = 'noti-added';
                break;
            case 'friend_added':
                text = 'You and ' + full_name + ' are now friends.';
                className = 'noti-added';
                break;
            case 'post_commented':
                text = full_name + ' commented on your ' + post + '.';
                className = 'noti-commented';
                break;
            case 'post_liked':
                text = full_name + ' liked your ' + post + '.';
                className = 'noti-liked';
                break;
        }
        return '<div class="box-subTitle clear-fix notification">' +
            '<img class="user-welcome-pic" src="user_content/photos/' + notification.user_profile_picture + '">' +
            '<span class="box-text">' + text + '</span>' +
            '<div class="' + className + '">' + moment(notification.date, "YYYY-MM-DD h:mm:ss").fromNow() + '</div>' +
        '</div>';
    }
};

$(function() {
    if (!$('#notifications-page').length) {
        return;
    }

    Notifications.loadNotifications();
    $('#load-more-btn').on('click', Notifications.loadNotifications);
});