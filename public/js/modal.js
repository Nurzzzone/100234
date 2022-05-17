$(document).ready(function() {
    let button = $('button[data-name="deleteModalButton"]');
    let form = $('form[data-name="deleteForm"]');
    let url = $(form).data('url');

    button.each((i, button) => {
        $(button).on('click', (e) => {
            e.stopPropagation();
            let target = $(button).data('target');
            form.attr('action', url + target);
            $('#deleteModal').modal('show');
        });
    });
});
