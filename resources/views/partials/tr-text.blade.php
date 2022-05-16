@if ($tr === 'text')
    <tr>
        <th class="align-middle">{{ $label ?? 'label' }}</th>
        <td class="{{ ! empty($data) ? '': 'text-muted' }}">{{ ! empty($data)? $data:  trans('messages.data.unavailable') }}</td>
    </tr>
@elseif ($tr === 'url')
<tr>
    <th class="align-middle">{{ $label ?? 'label' }}</th>
    <td class="{{ ! empty($data) ? '': 'text-muted' }}">
        <a href="{{ ! empty($data) ? '': 'text-muted' }}">{{ ! empty($data)? $data:  trans('messages.data.unavailable') }}</a>
    </td>
</tr>
@else 
    <tr>
        <th class="align-start">{{ $label ?? 'label' }}</th>
        <td class="{{ ! empty($data) ? '': 'text-muted' }}">{!! ! empty($data)? $data:  trans('messages.data.unavailable') !!}</td>
    </tr>
@endif