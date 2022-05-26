@if(! $plainText)
    <td class="{{ $class }}">
        {!! $column ?? trans('messages.data.unavailable') !!}
    </td>
@else
    {!! $object->$column !== null? $object->$column: trans('messages.data.unavailable') !!}
@endif
