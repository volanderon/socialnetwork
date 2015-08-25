var Utils = {
    logout: function () {
        $.ajax({
            type: "POST",
            url: "api/logout",
            success: function() {
                window.location = 'index.php';
            }
        });
    }
};

$(function() {
    $('#logout').on('click', function () {
        Utils.logout();
    })
});



