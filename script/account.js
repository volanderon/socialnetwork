var Account = {
    /**
     * Populate day, month & year selects with values
     */
    populateBirthdaySelects: function() {
        var days_html = '', months_html = '', years_html = '',
            months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            current_year = new Date().getFullYear(),
            birthdate = $('#account-form').data('birthdate').split('-');
        for (var i = 1; i <= 31; i++) {
            days_html += '<option ' + (birthdate[2] == i ? 'selected' : '') + ' value="' + i + '">' + i + '</option>';
        }
        for (var j = 1; j <= 12; j++) {
            months_html += '<option ' + (birthdate[1] == j ? 'selected' : '') + ' value="' + j + '">' + months[j] + '</option>';
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
        if (!form[0].checkValidity()) {
            return;
        }
        $.ajax({
            type: "PUT",
            url: "api/user",
            data: data,
            success: function( error ) {
                if (error) {
                    $('#update-user-error').slideDown().find('span').html(error);
                } else {
                    $('#update-user-error').slideUp();
                }
            },
            dataType: 'json'
        });
        return false;
    },
    selectTab: function() {
        var selected_tab = $(this).data('tab');
        $('#left-section .box').hide();
        $('#tab-' + selected_tab).fadeIn('normal');
    }
};

$(function() {
    Account.populateBirthdaySelects();
    $('#update-user-btn').on('click', Account.updateUser);
    $('#account-tabs').on('click', '.box-subTitle', Account.selectTab);
});