var Utils = {
    /**
     * Calls logout api and redirects to index page
     */
    logout: function () {
        $.ajax({
            type: "POST",
            url: "api/logout",
            success: function () {
                window.location = 'index.php';
            }
        });
    },
    /**
     * Reads a selected image via FileReader and previews it in an img tag
     * @param input
     * @param img
     */
    previewImage: function (input, img) {
        if (!input.files || !input.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            img.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    },
    get_profile_picture: function (pic) {
        return pic ? 'user_content/photos/' + pic + '?' + Date.now() : 'images/thumbs/thumb_008.jpg';
    },
    get_cover_picture: function (pic) {
        return pic ? 'user_content/covers/' + pic + '?' + Date.now() : 'images/cover-default.jpg';
    }
};

$(function() {
    $('#logout').on('click', function () {
        Utils.logout();
    })
});



