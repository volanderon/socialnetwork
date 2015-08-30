var Index = {
    /**
     * Checks if form is valid, if yes - creates a new user and redirects to account page
     */
    register: function () {
        var form = $('form#register'), data;
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
                    $('#reg-error').slideDown().find('span').html(error);
                } else {
                    $('#reg-error').slideUp();
                    window.location = 'account.php';
                }
            },
            dataType: 'json'
        });
        return false;
    },
    /**
     * Checks if user exists, if yes - logs in and redirects to home page
     */
    login: function () {
        var form = $('form#login'), data = JSON.stringify(form.serializeArray());
        if (!form[0].checkValidity()) {
            return;
        }
        $.ajax({
            type: "POST",
            url: "api/login",
            data: data,
            success: function( error ) {
                if (error) {
                    $('#login-error').slideDown().find('span').html(error);
                } else {
                    $('#login-error').slideUp();
                    window.location = 'home.php';
                }
            },
            dataType: 'json'
        });
        return false;
    }
};

$(function() {
    if (!$('#index-page').length) {
        return;
    }
    $('#reg-btn').on('click', Index.register);
    $('#login-btn').on('click', Index.login);
});
