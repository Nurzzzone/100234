<tr>
    @php($locale = $locale ?? 'is_active')
    <th class="align-middle">{{ trans('fields.'.$locale) }}</th>
    <td class="{{ $data? 'text-success': 'text-danger' }}">
        {{ $data? trans('fields.active'): trans('fields.not_active') }}
    </td>
</tr>