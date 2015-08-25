var Index = {

};

$(function() {
    $('#reg-btn').on('click', function () {
        var form = $('form'), data;
        if ($('[name="password"]').val() && $('[name="password"]').val() !== $('[name="password_confirm"]').val()) {
            $('[name="password_confirm"]')[0].setCustomValidity('Passwords Don\'t Match');
        } else {
            $('[name="password_confirm"]')[0].setCustomValidity('');
        }
        if (!form[0].checkValidity()) {
            return;
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
                    $('.error').slideUp();
                    window.location = 'account.php';
                }
            },
            dataType: 'json'
        });
        return false;
    });
});
