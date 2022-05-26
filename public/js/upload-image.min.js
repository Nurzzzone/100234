$(document).ready(function() {
    let uploadImageDiv = $('.avatar-upload'),
        prevFile = $('#prevImage'),
        fileInput = $('#imageUpload');

    // setup
    uploadImageDiv.each(function(index, block) {
        let deleteButton = $(block).find('button[data-name="deleteButton"]'),
            imagePreview = $(block).find('div[data-name="imagePreview"]'),
            imageInput = $(block).find('input[data-name="imageUpload"]'),
            prevImage = $(block).find('input[data-name="prevImage"]');

        $(imageInput).change(function() {
            readURL(this, imagePreview, deleteButton, prevImage);
        });

        $(deleteButton).click(function(e) {
            e.preventDefault();
            setDeleteButton(this, imagePreview, imageInput, prevImage);
        });
    });
    

    $(fileInput).next('.custom-file-label').html($(prevFile).val());
    $(fileInput).change(function() {
        let fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
        readFileUrl(this);
    });

    // For image
    function readURL(input, imagePreview, deleteButton, prevImage) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $(imagePreview).css('background-image', 'url('+e.target.result +')');
                $(deleteButton).removeAttr('disabled');
                $(deleteButton).removeClass('d-none');
                if ($(prevImage).val() !== null && $(prevImage).val() !== '') {
                    $(prevImage).val('');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // for files
    function readFileUrl(input) {
        if (input.files && input.files[0]) {

            let reader = new FileReader();
            reader.onload = function() {
                if ($(prevFile).val() !== null && $(prevFile).val() !== '') {
                    $(prevFile).val('');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }

    }

    // set delete button
    function setDeleteButton(button, imagePreview, imageInput, prevImage) {
        let image = $(button).data('default');
        $(imagePreview).css('background-image', `url(${ image })`);
        $(button).addClass('d-none');
        $(button).attr('disabled', 'disabled');
        $(imageInput).val('');
        if ($(prevImage).val() !== null && $(prevImage).val() !== '') {
            $(prevImage).val('');
        }
    }
});
