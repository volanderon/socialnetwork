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
    }
};

$(function() {
    if (!$('#home-page').length) {
        return;
    }

    $('#new-post-btn').on('click', Home.addNewPost);
});