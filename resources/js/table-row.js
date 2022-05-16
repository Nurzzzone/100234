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

    $('#delivery-status').on('change', function() {
        let orderId = $(this).data('id'),
            csrfToken = $('meta[name="csrf-token"]').attr('content'),
            status = $(this).val(),
            successFlashMessage = $('#success-flash-alert'),
            errorFlashMessage = $('#error-flash-alert');

        $.ajax({
            url: `/admin/orders/${orderId}`,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            method: 'POST',
            data: {
               status: status,
            },
            success: function(response){
                if (successFlashMessage.hasClass('d-none')) {
                let message = `<p class="flash-message m-0">${response.message}</p>`;
                    successFlashMessage.find('.alert').append(message);
                    successFlashMessage.removeClass('d-none');
                }
            },
            error: function(error) {
                if (errorFlashMessage.hasClass('d-none')) {
                let message = `<p class="flash-message m-0">${error.message}</p>`;
                    errorFlashMessage.find('.flash-message').append(message);
                    successFlashMessage.removeClass('d-none');
                }
            }
        });
    });

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
