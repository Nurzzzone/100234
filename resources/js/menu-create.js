$(document).ready(function() {
    let openModalButtons = $('button[data-name="modal-content-button"]');
    let form;
    let modal;

    openModalButtons.each((i, button) => {
        modal = $('#' + $(button).data('for'));
        //
        // form = modal.find('form');

        $(button).on('click', (e) => {
            e.stopPropagation();

            modal.modal('show');
        });
    });

    // form.submit(function(e) {
    //     e.preventDefault();
    //     modal.hide();
    //
    //     $.ajax({
    //         url: '/menu/element/createElement',
    //         method: 'POST',
    //         data: $(this).serialize(),
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         beforeSend: function(xhr, settings) {
    //             console.log(settings.data)
    //         },
    //         success: function() {
    //             modal.hide();
    //         },
    //         error: function(response) {
    //             alert(response.status + ': Произошла ошибка. Попробуйте еще раз!')
    //         }
    //     })
    // });
});

