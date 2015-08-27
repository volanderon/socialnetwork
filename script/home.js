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

    $('#new-post-btn').on('click', Home.addNewPost);
    $('body').on('click', '.post-delete', Home.deletePost);
});