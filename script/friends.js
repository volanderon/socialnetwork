var Friends = {
    /**
     * Add or remove a friend request on current user's profile
     */
    addFriend: function() {
        if ($(this).hasClass('add-friend-icon')) {
            $.ajax({type: "POST", url: "api/friend", data: JSON.stringify({friend_id: viewedUser.user_id})});
        } else {
            $.ajax({type: "DELETE", url: "api/friend", data: JSON.stringify({friend_id: viewedUser.user_id})});
        }
        $(this).toggleClass('add-friend-icon remove-friend-icon');
    },
    friends_to_remove: [],
    /**
     * Remove / cancel remove friend on session user's friends page list
     * Removes only when navigating away from the page
     */
    removeFriend: function() {
        var friend_id = $(this).parents('.box').data('friend-id');
        $(this).toggleClass('add-friend-icon remove-friend-icon');
        if ($.inArray(friend_id, Friends.friends_to_remove) > -1) {
            Friends.friends_to_remove.splice(Friends.friends_to_remove.indexOf(friend_id), 1);
        } else {
            Friends.friends_to_remove.push(friend_id);
        }
        window.onbeforeunload = function() {
            $.ajax({type: "DELETE", url: "api/friends", data: JSON.stringify({friends_to_remove: Friends.friends_to_remove})});
        };
    }
};

$(function() {
    if (!$('#profile-page').length && !$('#friends-page').length) {
        return;
    }

    $('#profile-cover .add-friend-icon, #profile-cover .remove-friend-icon').on('click', Friends.addFriend);
    $('#left-section .remove-friend-icon').on('click', Friends.removeFriend);
});