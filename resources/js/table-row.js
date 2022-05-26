$(document).ready(function() {
    let tableRow = $('tr[data-name="tableRow"]');
    if ($(tableRow).length) {
        $(tableRow).each((index, element) => {
            $(element).click(() => {
                window.location = $(element).data('href');
            });
        });
    }

    let table = $('.table');
    let tableHeaders = $(table).find('th').length;
    let tableEmpty = $('#tableEmpty');

    if ($(tableEmpty).length) {
        $(tableEmpty).attr('colspan', tableHeaders)
    }

    $('#dismiss-success-button').on('click', function(e) {
        e.preventDefault();
        let successFlashMessage = $('#success-flash-alert');
        if (!successFlashMessage.hasClass('d-none')) {
            successFlashMessage.find('.flash-message').remove();
            successFlashMessage.addClass('d-none');
        }
    });

    $('#dismiss-error-button').on('click', function(e) {
        e.preventDefault();
        let errorFlashMessage = $('#error-flash-alert');
        if (!errorFlashMessage.hasClass('d-none')) {
            errorFlashMessage.find('.flash-message').remove();
            errorFlashMessage.addClass('d-none');
        }
    });
});
