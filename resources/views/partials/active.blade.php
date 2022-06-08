<tr>
    <th class="align-middle">{{ $label ?? trans(($locale ?? 'fields.is_active')) }}</th>
    <td>
        <div class="custom-control custom-radio pl-0 mt-50">
            {{ Form::radio($field ?? 'is_active', 1, true, ['id' => $id ?? 'active', 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']]) }}
            {{ Form::label($id ?? 'active', trans('fields.active'), ['class' => 'label-active text-muted font-small-1 cursor-pointer']) }}
        </div>
        <div class="custom-control custom-radio pl-0">
            @php($not_id = isset($id)? "not_$id": 'inactive')
            {{ Form::radio($field ?? 'is_active', 0, false, ['id' => $not_id, 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']]) }}
            {{ Form::label($not_id, trans('fields.not_active'), ['class' => 'label-active text-muted font-small-1 cursor-pointer']) }}
        </div>
    </td>
</tr>
