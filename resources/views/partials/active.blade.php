<tr>
    <th class="align-middle">@lang($locale ?? 'fields.is_active')</th>
    <td>
        <div class="custom-control custom-radio pl-0 mt-50">
            {{ Form::radio($field ?? 'is_active', 1, true, ['id' => $on ?? 'active', 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']]) }}
            {{ Form::label($on ?? 'active', trans('fields.active'), ['class' => 'label-active text-muted font-small-1 cursor-pointer']) }}
        </div>
        <div class="custom-control custom-radio pl-0">
            {{ Form::radio($field ?? 'is_active', 0, false, ['id' => $off ?? 'inactive', 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']]) }}
            {{ Form::label($off ?? 'inactive', trans('fields.not_active'), ['class' => 'label-active text-muted font-small-1 cursor-pointer']) }}
        </div>
    </td>
</tr>
