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
@elseif ($tr === 'textarea')
    <tr class="textarea-editor">
        <th class="align-start">{{ $label ?? 'label' }}</th>
        <td class="{{ ! empty($data) ? '': 'text-muted' }}">{!! ! empty($data)? $data:  trans('messages.data.unavailable') !!}</td>
    </tr>
@elseif ($tr === 'text-multiple')
    <tr>
        @foreach($data as $input)
            <td class="{{ ! empty($input) ? '': 'text-muted' }}">{{ ! empty($input)? $input:  trans('messages.data.unavailable') }}</td>
        @endforeach
    </tr>
@else
    <tr>
        <th class="align-start">{{ $label ?? 'label' }}</th>
        <td class="{{ ! empty($data) ? '': 'text-muted' }}">{!! ! empty($data)? $data:  trans('messages.data.unavailable') !!}</td>
    </tr>
@endif