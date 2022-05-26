$(document).ready(function() {
    'use strict'

    let editors = $('div[data-name="editor"]');
    let Font = Quill.import('formats/font');

    Font.whitelist = ['inconsolata', 'roboto', 'mirza', 'arial'];
    Quill.register(Font, true);

    let toolbarOptions = [
        [{ 'header': [4, 5, 6, false] }],
        ['bold', 'italic', 'underline'],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'list': 'bullet' }, { 'list': 'ordered' }],
        [{ 'align': [] }],
    ];

    $(editors).each((index, editor) => {
        let placeholder = $(editor).data('placeholder');
        let quill = new Quill(editor, {
            modules: {
                toolbar: toolbarOptions,
            },
            placeholder: placeholder,
            theme: 'snow'  // or 'bubble'
        });
        let editorTarget = $(editor).prev().prev();
        let editorObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                let value = '';
                if ($(editor).find('div[class="ql-editor"]').length) {
                    value = $(editor).find('div[class="ql-editor"]')[0].innerHTML;
                }
                $(editorTarget).val(value);
            });
        });
        editorObserver.observe(editor, {
            characterData: true,
            subtree: true,
            childList: true
        });
    });

    let editorsValue = $('td[data-name="editorValue"]');

    if (editorsValue.length) {
        setTargetValue();
    } else {
        editorsValue = $('input[data-name="editorTarget"]');
        setTargetContent(editorsValue);
    }

    function setTargetValue() {
        editorsValue.each((index, editorValue) => {
            let html = $(editorValue).data('value');
            $(editorValue).html(html);
        });
    }

    function setTargetContent(editorsValue) {
        editorsValue.each((index, editorValue) => {
            let value = $(editorValue).data('value');
            let editor = $(editorValue).next().next($('div[data-name="editor"]'));
            let target = $(editor).find('.ql-editor');
            target.html(value);
        });
    }
});
