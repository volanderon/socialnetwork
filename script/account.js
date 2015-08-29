var Account = {
    /**
     * Populate day, month & year selects with values
     */
    populateBirthdaySelects: function() {
        var days_html = '<option value="">Choose</option>',
            months_html = '<option value="">Choose</option>',
            years_html = '<option value="">Choose</option>',
            months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            current_year = new Date().getFullYear(),
            birthdate = $('#account-form').data('birthdate').split('-');
        for (var i = 1; i <= 31; i++) {
            days_html += '<option ' + (birthdate[2] == i ? 'selected' : '') + ' value="' + i + '">' + i + '</option>';
        }
        for (var j = 1; j <= 12; j++) {
            months_html += '<option ' + (birthdate[1] == j ? 'selected' : '') + ' value="' + j + '">' + months[j-1] + '</option>';
        }
        for (var k = current_year; k >= current_year - 100; k--) {
            years_html += '<option ' + (birthdate[0] == k ? 'selected' : '') + ' value="' + k + '">' + k + '</option>';
        }
        $('#birth-day').html(days_html);
        $('#birth-month').html(months_html);
        $('#birth-year').html(years_html);
    },
    updateUser: function() {
        var form = $('#account-form'), data = JSON.stringify(form.serializeArray());
        $('.error, .success').hide();

        if (!form[0].checkValidity()) {
            return;
        }

        $.ajax({
            type: "PUT",
            url: "api/user",
            data: data,
            success: function( error ) {
                if (error) {
                    $('#left-section > div:visible .error').slideDown().find('span').html(error);
                } else {
                    $('#left-section > div:visible .success').slideDown();
                }
            },
            dataType: 'json'
        });
        return false;
    },
    uploadImage: function(id, name, url) {
        var file = $(id)[0].files[0],
            formData = new FormData();
        $('.error, .success').hide();

        if (!file) {
            return;
        }

        if (file.type.match('image.*')) {
            formData.append(name, file);
        }

        $.ajax({
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function() {
                $('#left-section > div:visible .success').slideDown();
            }
        });
    },
    changePassword: function() {
        var form = $('form#change-password-form'), data;
        $('.error, .success').hide();

        if ($('[name="newPassword"]').val() && $('[name="newPassword"]').val() !== $('[name="repeatNewPassword"]').val()) {
            $('[name="repeatNewPassword"]')[0].setCustomValidity('Passwords Don\'t Match');
        } else {
            $('[name="repeatNewPassword"]')[0].setCustomValidity('');
        }
        if (!form[0].checkValidity()) {
            return;
        }

        data = JSON.stringify(form.serializeArray());
        $.ajax({
            type: "PUT",
            url: "api/changePassword",
            data: data,
            success: function( error ) {
                if (error) {
                    $('#left-section > div:visible .error').slideDown().find('span').html(error);
                } else {
                    form[0].reset();
                    $('#left-section > div:visible .success').slideDown();
                }
            },
            dataType: 'json'
        });
        return false;
    },
    selectTab: function(e, tab) {
        var selected_tab = tab ? tab : $(this).data('tab');
        console.log(selected_tab);
        $('#left-section .box').hide();
        $('#tab-' + selected_tab).fadeIn('normal');
        $('.box-partial').removeClass('selected');
        $('.box-partial[data-tab="' + selected_tab + '"]').addClass('selected');
    }
};

$(function() {
    if (!$('#account-page').length) {
        return;
    }

    $('#account-tabs').on('click', '.box-partial', Account.selectTab);
    if (window.location.hash) {
        Account.selectTab(null, window.location.hash.replace('#', ''));
    } else {
        $('.box-partial[data-tab="general"]').addClass('selected');
    }

    // General tab
    Account.populateBirthdaySelects();
    $('#update-user-btn').on('click', Account.updateUser);

    // Images tab
    $('#upload-photo-btn').on('click', function() {
        Account.uploadImage('#photo-input', 'photo', 'api/uploadPhoto');
    });
    $('#upload-cover-btn').on('click', function() {
        Account.uploadImage('#cover-input', 'cover', 'api/uploadCover');
    });
    $("#photo-input").on('change', function(){
        Utils.previewImage(this, $('#photo-img'));
    });
    $("#cover-input").on('change', function(){
        Utils.previewImage(this, $('#cover-img'));
    });

    // Password tab
    $('#change-password-btn').on('click', Account.changePassword);
});