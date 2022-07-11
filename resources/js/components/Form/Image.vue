<template>
    <tr>
        <Label/>
        <td>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    @php
                    if (! is_null($current_image)) {
                    $image = asset(str_replace('\\', '/', $current_image));
                    } else {
                    $image = asset('assets/images/default-image.jpg');
                    }
                    @endphp
                    <div class="avatar-edit">
                        <input class="custom-file-input" :id="uploadImageId" data-name="imageUpload" type="file">
                        <input type="hidden" id="prevImage" data-name="prevImage">
                        <label :for="uploadImageId">
                            <i class="cil-pencil"></i>
                        </label>
                    </div>
                    <button data-name="deleteButton"
                            data-default="{{ asset('assets/images/default-image.jpg') }}"
                            class="btn avatar-delete {{ $current_image !== null? '': 'd-none' }}"
                            type="button" {{ $current_image !== null? '': 'disabled' }}><i class="cil-x"></i>
                    </button>
                    <div data-name="imagePreview" style="background-image: url({{ $image }});"></div>
                </div>
            </div>
        </td>
    </tr>

</template>

<script>
import Label from "./Label";
import uuid from "../../mixins/uuid";

export default {
    name: "Image",
    components: {Label},
    mixins: [uuid],
    data() {
        return {
            uploadImageId: '',
            prevImageId: '',
        }
    },
    created() {
        this.uploadImageId = this.uuid.v4()
        this.prevImageId = this.uuid.v4()
    },
}
</script>

<style scoped>

</style>
