<tr>
    <th class="align-middle">{{ $label ?? trans('fields.is_active') }}</th>
    <td class="{{ $data? 'text-success': 'text-danger' }}">
        {{ $data? trans('fields.active'): trans('fields.not_active') }}
    </td>
</tr>