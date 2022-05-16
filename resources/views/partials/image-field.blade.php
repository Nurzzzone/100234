<tr>
    <th class="align-start">
        <span class="mt-2 d-block">{{ trans_choice($locale ?? 'fields.image', $prular ?? 1) }}</span>
    </th>
    <td>
        <div class="avatar-upload">
            <div class="avatar-preview">
                @php
                    if ($current_image !== null) {
                        $image = asset(str_replace('\\', '/', $current_image));
                    } else {
                        $image = asset('images/defaults/background.jpg');
                    }
                @endphp
                <div class="avatar-edit">
                    {{ Form::file($field ?? 'image', ['class' => 'custom-file-input', 'id' => $element_id ?? 'imageUpload', 'data-name' => 'imageUpload']) }}
                    {{ Form::hidden($prev_field ?? 'previous_image', $current_image ?? null, ['data-name' => 'prevImage']) }}
                    <label for="{{ $element_id ?? 'imageUpload' }}">
                        <svg class="c-icon mr-2 edit-icon">
                            <use xlink:href="{{ url('/icons/sprites/free.svg#cil-pencil') }}"></use>
                        </svg>
                    </label>
                </div>
                <button data-name="deleteButton"
                        data-default="{{ asset('assets/img/defaults/background.jpg') }}"
                        class="btn avatar-delete {{ $current_image !== null? '': 'd-none' }}"
                        type="button" {{ $current_image !== null? '': 'disabled' }}>
                    <svg class="c-icon mr-2 delete-icon">
                        <use xlink:href="{{ url('/icons/sprites/free.svg#cil-x') }}"></use>
                    </svg>
                </button>
                <div data-name="imagePreview" style="background-image: url({{ $image }});">
                </div>
            </div>
        </div>
    </td>
</tr>
