var Utils = {
    logout: function () {
        $.ajax({
            type: "POST",
            url: "api/logout",
            success: function () {
                window.location = 'index.php';
            }
        });
    },
    previewImage: function (input, img) {
        if (!input.files || !input.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            img.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function() {
    $('#logout').on('click', function () {
        Utils.logout();
    })
});



