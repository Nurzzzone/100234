<tr>
    <th class="align-middle">@lang($locale ?? 'fields.password')</th>
    @php
        $options = [
            'class'       => ['form-control', $errors->has($field ?? 'password')? 'border-danger' : ''],
            'placeholder' => trans($locale ?? 'fields.password')
        ];
    @endphp
    <td>
        {{ Form::password($field ?? 'password', $options) }}
    </td>
</tr>