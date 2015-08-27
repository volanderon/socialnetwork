var Home = {
    addNewPost: function() {
        var content = $('#new-post-content').val();

        if (content.trim() === '') {
            alert('Please type something...');
            return;
        }
        $('#new-post-content').val('');

        $.ajax({
            type: "POST",
            url: "api/post",
            data: JSON.stringify(content),
            success: function(post) {
                $('#posts').prepend(Home.buildPostHtml(post)).find('.post:first-child').hide().slideDown();
            }
        });
    },
    offset: 0,
    loadMorePosts: function() {
        $.ajax({
            type: "GET",
            url: "api/posts/" + Home.offset + "/3",
            success: function(posts) {
                if (!posts.length) {
                    $('#load-more-posts-btn').remove();
                }
                $.each(posts, function(key, post) {
                    $('#posts').append(Home.buildPostHtml(post));
                });
                $('#posts .box').slice(-3).hide().slideDown()
            }
        });
        Home.offset += 3;
    },
    buildPostHtml: function(post) {
        return '<div class="box post" data-post-id="' + post.post_id + '">' +
                '<div class="clear-fix">' +
                    '<img class="user-welcome-pic" src="user_content/photos/' + post.user_profile_picture + '">' +
                    '<div class="details">' +
                        post.user_firstname + ' ' + post.user_lastname + '<br>' +
                        post.post_created +
                    '</div>' +
                '</div>' +
                '<div>' + post.post_content + '</div>' +
                ($('body').data('curr-user-id') == post.user_id ? '<div class="post-delete"></div>' : '') +
            '</div>';
    },
    deletePost: function() {
        if (!confirm('Are you sure')) {
            return;
        }
        var post = $(this).parents('.post'), post_id = post.data('post-id');
        $.ajax({
            type: "DELETE",
            url: "api/post",
            data: JSON.stringify(post_id),
            success: function() {
                post.slideUp(function() { $(this).remove(); });
            }
        });
    }
};

$(function() {
    if (!$('#home-page').length) {
        return;
    }

    Home.loadMorePosts();

    $('#new-post-btn').on('click', Home.addNewPost);
    $('#load-more-posts-btn').on('click', Home.loadMorePosts);
    $('body').on('click', '.post-delete', Home.deletePost);
});