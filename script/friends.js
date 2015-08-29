var Friends = {
    addFriend: function() {
        if ($(this).hasClass('add-friend-icon')) {
            $.ajax({type: "POST", url: "api/friend", data: JSON.stringify({friend_id: viewedUser.user_id})});
        } else {
            $.ajax({type: "DELETE", url: "api/friend", data: JSON.stringify({friend_id: viewedUser.user_id})});
        }
        $(this).toggleClass('add-friend-icon remove-friend-icon');
    }
};

$(function() {
    if (!$('#profile-page').length && !$('#friends-page').length) {
        return;
    }

    $('#profile-cover .add-friend-icon, #profile-cover .remove-friend-icon').on('click', Friends.addFriend);
});