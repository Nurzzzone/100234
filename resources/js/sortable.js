$(document).ready(function() {
    $(function () {
        const table = $('#sortable-table');
        let sequence = [];


        $("#sortable-table").sortable({
            items: 'tbody tr',
            cursor: 'pointer',
            dropOnEmpty: false,
            update: function() {
                let items = $(table).find('tbody').find('tr');

                items.each(function(key, item) {
                    sequence.push({
                        id: $(item).data('id'),
                        sequence: key + 1
                    });
                });

                $.ajax({
                    url: $('#sortable-table').data('update-sequence-url'),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { sequence: sequence },
                });

                sequence = []
            }
        })
    });
});