<tr>
    <th class="align-middle">{{ trans_choice($locale, $plural ?? 1) }}</th>
    @php
        $options = [
            'class' => ['form-control', $errors->has($field) ? 'border-danger' : ''],
            'placeholder' => empty($select_options)? trans('messages.data.unavailable'): null,
            empty($select_options)? 'disabled': '',
        ];
    @endphp
    <td>{{ Form::select($field, $select_options, $default, $options) }}</td>
</tr>