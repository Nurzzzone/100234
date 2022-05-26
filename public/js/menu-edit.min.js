$(document).ready(function() {
    let buttons = $('button[data-name="editModalButton"]');
    let form = $('#editForm')
    let url = $(form).data('url');
    let target;

    $('#menu-input-parent').change(function() {
        if ($(this).val() !== '_') {
            $('#menu-input-slug').find('option[value="dropdown"]').attr('disabled', true)
            $('#menu-input-slug').val('link');
        } else {
            $('#menu-input-slug').find('option[value="dropdown"]').attr('disabled', false)
        }
    })

    buttons.each((i, button) => {
        $(button).on('click', (e) => {
            e.stopPropagation();

            target = $(button).data('target');

            $.ajax({
                url: '/menu/' + target,
                success: function(data) {
                    $('#menu-input-name').val(data.name)
                    $('#menu-input-link').val(data.href)
                    $('#menu-input-icon').val(data.icon)
                    $('#menu-input-sequence').val(data.sequence)

                    if (data.slug === 'dropdown') {
                        $('#menu-input-parent').find(`option[value="${data.parent_id}"]`).hide()
                    }

                    if (data.parent_id) {
                        $('#menu-input-parent').val(data.parent_id)
                    }
                    $('#menu-input-slug').val(data.slug)
                },
                error: function() {
                    alert('Произошла ошибка. Попробуйте еще раз!')
                }
            })

            form.attr('action', url + target);
            $('#update-modal').modal('show');
        });
    });

    // form.submit(function(e) {
    //     e.preventDefault();
    //
    //     $.ajax({
    //         url: '/menu/element/updateElement/' + target,
    //         method: 'PUT',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: $(this).serialize(),
    //         success: function() {
    //             $('#update-modal').hide();
    //         }
    //     })
    // })
})


