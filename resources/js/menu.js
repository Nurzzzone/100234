$(document).ready(function () {
    const svg = {
        pencil: '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="10" height="10" viewBox="0 0 528.899 528.899" style="enable-background:new 0 0 528.899 528.899;" xml:space="preserve"><g>' +
            '<path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981 c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611 C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069 L27.473,390.597L0.3,512.69z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>' +
            '</svg>',
        delete: '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"' +
            'width="10" height="10" viewBox="0 0 94.926 94.926" style="enable-background:new 0 0 94.926 94.926;"' +
            'xml:space="preserve"><g> ' +
            '<path d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0' +
            'c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096' +
            'c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476' +
            'c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62' +
            's1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/>' +
            '</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g> ' +
            '</svg>'
    };

    (function () {
        new NestedSort({
            data: $('#menu').data('value'),
            actions: {
                onDrop: function (data) {
                    $.ajax({
                        url: '/menu/element/updateSequence/',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            sequence: data
                        },
                        error: function() {
                            alert('Произошла ошибка')
                        }
                    })
                }
            },
            propertyMap: {
                parent: 'parent_id',
                text: 'name',
                order: 'sequence'
            },
            el: '#menu',
            nestingLevels: 1,
            renderListItem: (element, { id }) => {
                $(element).append(`
                            <div class="float-right align-middle">
                                <button class="btn mr-2"
                                    data-toggle="modal"
                                    data-name="editModalButton"
                                    data-target="${id}"
                                    type="button">${svg.pencil}</button>
                                <button class="btn"
                                    data-toggle="modal"
                                    data-name="deleteModalButton"
                                    data-target="${id}"
                                    type=button>${svg.delete}</button>
                            <div>`)
                return element
            },
        })
    })();
});
