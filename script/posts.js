var Posts = {
    /**
     * Adds a new post
     */
    addNewPost: function() {
        var new_post = $('#new-post-content'),
            content = new_post.val();

        if (content.trim() === '') {
            alert('Please type something...');
            return;
        }
        new_post.val('');

        $.ajax({
            type: "POST",
            url: "api/post",
            data: JSON.stringify(content),
            success: function(post) {
                $('#posts').prepend(Posts.buildPostHtml(post, '', '', 0)).find('.post:first-child').hide().slideDown();
            }
        });
    },
    /**
     * Adds a new comment to a post
     * @param e
     */
    addNewComment: function(e) {
        var content = $(this).val(),
            post = $(this).parents('.post'),
            post_id = post.data('post-id');

        if (e.which !== 13) {
            return;
        }
        if (content.trim() === '') {
            alert('Please type something...');
            return;
        }
        $(this).val('');

        $.ajax({
            type: "POST",
            url: "api/post/comment",
            data: JSON.stringify({post_id: post_id, content: content}),
            success: function(comments) {
                post.find('.post-comments').append(Posts.buildCommentsHtml(post_id, comments)).find('.comment:last-child').hide().slideDown();
            }
        });
    },
    post_offsets: {},
    /**
     * Load 5 more comments each call
     */
    viewMoreComments: function() {
        var post = $(this).parents('.post'),
            post_id = post.data('post-id');
        if (!Posts.post_offsets[post_id]) {
            Posts.post_offsets[post_id] = 3;
        }
        $.ajax({
            type: "GET",
            url: "api/post/comments/" + post_id + "/" + Posts.post_offsets[post_id] + "/5",
            success: function(comments) {
                var len = comments[post_id].length;
                post.find('.post-comments').prepend(Posts.buildCommentsHtml(post_id, comments));
                if (len) {
                    post.find('.post-comments .comment').slice(0, Math.min(5, len)).hide().slideDown();
                } else {
                    post.find('.view-more-comments').remove();
                }
            }
        });
        Posts.post_offsets[post_id] += 5;
    },
    offset: 0,
    /**
     * Loads x amount of posts from offset y each time it is called
     * @param is_profile_page
     */
    loadMorePosts: function(is_profile_page) {
        $.ajax({
            type: "GET",
            url: "api/posts/" + (is_profile_page ? viewedUser.user_id : 0) + '/' + Posts.offset + "/3",
            success: function(data) {
                var len = data['posts'].length;
                $.each(data['posts'], function(key, post) {
                    var likes_html = Posts.buildLikesHtml(post.post_id, data['likes']),
                        comments_html = Posts.buildCommentsHtml(post.post_id, data['comments']);
                    $('#posts').append(Posts.buildPostHtml(post, likes_html, comments_html, data['comments'][post.post_id].length));
                });
                if (len) {
                    $('#posts .box').slice(-(Math.min(3, len))).hide().slideDown();
                } else {
                    $('#load-more-posts-btn').remove();
                }
            }
        });
        Posts.offset += 3;
    },
    /**
     * Load a single post
     * Get post id from data attribute on the #posts div
     */
    loadSinglePost: function() {
        var post_id = $('#posts').data('post-id');
        $.ajax({
            type: "GET",
            url: "api/post/" + post_id,
            success: function(data) {
                var likes_html = Posts.buildLikesHtml(data.posts[0].post_id, data['likes']),
                    comments_html = Posts.buildCommentsHtml(data.posts[0].post_id, data['comments']);
                $('#posts').append(Posts.buildPostHtml(data.posts[0], likes_html, comments_html, data['comments'][data.posts[0].post_id].length));
            }
        });
    },
    /**
     * Builds the html for a single post
     * Accepts likes & comments html as params to concat into the template
     * @param post
     * @param likes_html
     * @param comments_html
     * @returns {string}
     */
    buildPostHtml: function(post, likes_html, comments_html, comments_len) {
        var likes_users = !post.likes_users ? [] : post.likes_users.split('-'),
            is_i_liked = $.inArray(auth.user_id, likes_users) > -1;
        return '<div class="box post clear-fix" data-post-id="' + post.post_id + '">' +
                '<div class="clear-fix">' +
                    '<img class="user-welcome-pic" src="user_content/photos/' + post.user_profile_picture + '">' +
                    '<div class="details">' +
                        '<a href="profile.php?user_id=' + post.user_id + '">' + post.user_firstname + ' ' + post.user_lastname + '</a><br>' +
                        '<a href="post.php?post_id=' + post.post_id + '">' + moment(post.post_created, "YYYY-MM-DD h:mm:ss").fromNow() + '</a>' +
                    '</div>' +
                '</div>' +
                '<div class="post-content">' + post.post_content + '</div>' +
                '<div class="post-subTitle">' +
                    '<span class="post-like-btn">' + (is_i_liked ? 'Unlike' : 'Like') + '</span> - ' +
                    '<span class="post-comment-btn">Comment</span>' +
                    '<div class="post-likes ' + (is_i_liked ? 'i-liked' : '') + '">' +
                        '<span class="pl-count">' + likes_users.length + '</span>' +
                        (is_i_liked ? '<img class="box-user-icon bui-me" src="user_content/photos/' + auth.user_profile_picture + '">' : '') +
                        likes_html +
                    '</div>' +
                '</div>' +
                (comments_len < 3 ? '' : '<div class="view-more-comments"><span>View more comments</span></div>') +
                '<div class="post-comments">' +
                    comments_html +
                '</div>' +
                '<div class="box-title">' +
                    '<img class="comnt-user-icon" src="user_content/photos/' + auth.user_profile_picture + '">' +
                    '<input class="new-comment" type="text" class="create-comment" placeholder="Leave a comment...">' +
                '</div>' +
                ($('body').data('curr-user-id') == post.user_id ? '<div class="post-delete"></div>' : '') +
            '</div>';
    },
    /**
     * Builds the liking users' pictures list
     * @param post_id
     * @param likes
     * @returns {string}
     */
    buildLikesHtml: function(post_id, likes) {
        if (!likes[post_id]) {
            return '';
        }
        var pictures = likes[post_id].pictures.split(','),
            likes_html = '';
        $.each(pictures, function(key, pic) {
            likes_html += '<img class="box-user-icon" src="user_content/photos/' + pic + '">';
        });
        return likes_html;
    },
    /**
     * Builds the html of a post's comments
     * @param post_id
     * @param comments
     * @returns {string}
     */
    buildCommentsHtml: function(post_id, comments) {
        if (!comments[post_id]) {
            return '';
        }
        var comments_html = '';
        $.each(comments[post_id], function(key, comment) {
            comments_html += '<div class="comment box-subTitle">' +
                '<img class="comnt-user-icon" src="user_content/photos/' + comment.user_profile_picture + '">' +
                '<div class="comnt-text">' +
                    '<div><a class="user-link" href="profile.php?user_id=' + comment.user_id + '">' + comment.full_name + '</a></div> ' +
                    comment.comment_content +
                    '<div>' + moment(comment.comment_time, "YYYY-MM-DD h:mm:ss").fromNow() + '</div>' +
                '</div>' +
            '</div>';
        });
        return comments_html;
    },
    /**
     * Confirm and delete a post
     */
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
    },
    /**
     * Like post and display it in the likes list
     */
    likePost: function() {
        var likes = $(this).parents('.post').find('.post-likes'),
            count = likes.find('.pl-count'),
            count_val = parseInt(count.text()),
            is_liked = likes.hasClass('i-liked'),
            post_id = $(this).parents('.post').data('post-id');
        $(this).text(is_liked ? 'Like' : 'Unlike');
        count.text(count_val + (is_liked ? -1 : 1));
        if (is_liked) {
            // Do unlike
            $.ajax({type: "PUT", url: "api/post/unlike", data: JSON.stringify(post_id)});
            likes.find('.bui-me').remove();
        } else {
            // Do like
            $.ajax({type: "PUT", url: "api/post/like", data: JSON.stringify(post_id)});
            likes.append('<img class="box-user-icon bui-me" src="user_content/photos/' + auth.user_profile_picture + '">');
        }
        likes.toggleClass('i-liked');
    },
    /**
     * Focus post's comment input
     */
    commentOnPost: function() {
        $(this).parents('.post').find('.new-comment').focus();
    }
};

$(function() {
    var body = $('body'),
        is_home_page = $('#home-page').length,
        is_profile_page = $('#profile-page').length,
        is_post_page = $('#post-page').length;

    if (!is_home_page && !is_profile_page && !is_post_page) {
        return;
    }

    if (is_post_page) {
        Posts.loadSinglePost();
    } else if (is_profile_page) {
        Posts.loadMorePosts(true);
        $('#load-more-posts-btn').on('click', function() {
            Posts.loadMorePosts(true);
        });
    } else {
        Posts.loadMorePosts(false);
        $('#load-more-posts-btn').on('click', function() {
            Posts.loadMorePosts(false);
        });
    }

    $('#new-post-btn').on('click', Posts.addNewPost);
    body.on('click', '.post-delete', Posts.deletePost);
    body.on('click', '.post-like-btn', Posts.likePost);
    body.on('click', '.post-comment-btn', Posts.commentOnPost);
    body.on('keyup', '.new-comment', Posts.addNewComment);
    body.on('click', '.view-more-comments', Posts.viewMoreComments);
});