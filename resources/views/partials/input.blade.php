<tr>
    <th class="align-middle">{{ $label ?? 'label' }}
        @isset($required)
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        @endisset
    </th>
    @php
        $options = [
            'class'       => ['form-control', $errors->has($field)? 'border-danger' : ''],
            'disabled'    => isset($disabled)? 'disabled': null,
            'required'    => $required ?? false,
            'placeholder' => $label ?? 'placeholder',
            'min'         => $min ?? '',
            'max'     => $max ?? ''
        ];
    @endphp
    <td>{{ Form::$input($field, $current_value ?? old($field), $options) }}</td>
</tr>
