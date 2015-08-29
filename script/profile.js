var Profile = {
    /**
     * Reset profile posts & offsets and send a new request with a filter
     */
    filterResults: function() {
        Posts.offset = 0;
        Posts.post_offsets = {};
        Posts.show_type = $(this).data('type');
        $('#posts').empty();
        $('.filter').removeClass('selected');
        $(this).addClass('selected');
        Posts.loadMorePosts(true);
    }
};

$(function() {
    if (!$('#profile-page').length) {
        return;
    }

    $('.filter').on('click', Profile.filterResults);
    $('.filter:eq(1)').addClass('selected');
});