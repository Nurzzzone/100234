<tr id="{{ $tr_id ?? '' }}">
    <th class="align-middle">{{ trans_choice($locale, $plural ?? 1) }}</th>
    @php
        $options = [
            'class' => ['form-control', $errors->has($field) ? 'border-danger' : ''],
            'placeholder' => empty($select_options)? trans('messages.data.unavailable'): null,
            empty($select_options)? 'disabled': '',
            'id' => $id ?? '_select-input',
        ];
    @endphp
    <td>
        {{ Form::select($field, $select_options, $default, $options) }}
        @if($errors->has($field))
            <small class="text-danger">{{ $errors->first($field) }}</small>
        @endif
    </td>
</tr>