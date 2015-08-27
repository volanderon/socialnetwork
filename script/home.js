var Home = {
    addNewPost: function() {
        var content = $('#new-post-content').val();

        if (content.trim() === '') {
            alert('Please type something...');
            return;
        }

        $.ajax({
            type: "POST",
            url: "api/post",
            data: JSON.stringify(content),
            success: function() {

            }
        });
    },
    offset: 0,
    loadMorePosts: function() {
        $.ajax({
            type: "GET",
            url: "api/posts/" + Home.offset + "/3",
            success: function(posts) {
                $.each(posts, function(key, post) {
                    console.log(post);
                    $('#posts').append(
                        '<div class="box post" data-post-id="' + post.post_id + '">' +
                            '<div class="clear-fix">' +
                                '<img class="user-welcome-pic" src="user_content/photos/' + post.user_profile_picture + '">' +
                                '<div class="details">' +
                                    post.user_firstname + ' ' + post.user_lastname + '<br>' +
                                    post.post_created +
                                '</div>' +
                            '</div>' +
                            '<div>' + post.post_content + '</div>' +
                            ($('body').data('curr-user-id') == post.user_id ? '<div class="post-delete"></div>' : '') +
                        '</div>'
                    );
                });
            }
        });
        Home.offset += 3;
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