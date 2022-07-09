@if(! $plainText)
    <td class="{{ $class }}">
        {!! empty($column)? trans('messages.data.unavailable'): $column !!}
    </td>
@else
    {!! empty($column)? trans('messages.data.unavailable'): $column !!}
@endif
