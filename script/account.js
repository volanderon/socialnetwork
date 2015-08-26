var Account = {
    /**
     * Populate day, month & year selects with values
     */
    populateBirthdaySelects: function() {
        var days_html = '', months_html = '', years_html = '',
            months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            current_year = new Date().getFullYear();
        for (var i = 1; i <= 31; i++) {
            days_html += '<option value="' + i + '">' + i + '</option>';
        }
        for (var j = 0; j <= 11; j++) {
            months_html += '<option value="' + months[j] + '">' + months[j] + '</option>';
        }
        for (var k = current_year; k >= current_year - 100; k--) {
            years_html += '<option value="' + k + '">' + k + '</option>';
        }
        $('#birth-day').html(days_html);
        $('#birth-month').html(months_html);
        $('#birth-year').html(years_html);
    }
};

$(function() {
    Account.populateBirthdaySelects();
});