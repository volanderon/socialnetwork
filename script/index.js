var Index = {

};

$(function() {
    $('#reg-btn').on('click', function () {
        var form = $('form'), data;
        if (!form[0].checkValidity()) {
            return false;
        }
        data = JSON.stringify(form.serializeArray());
        $.ajax({
            type: "POST",
            url: "api/user",
            data: data,
            success: function( error ) {
                if (error) {
                    $('.error').slideDown().find('span').html(error);
                } else {
                    //window.location = 'account.php';
                }
            },
            dataType: 'json'
        });
        return false;
    });
});
