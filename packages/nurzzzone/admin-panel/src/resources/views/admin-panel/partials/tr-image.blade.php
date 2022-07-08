<tr>
    <th class="align-middle">{{ trans_choice($locale ?? 'fields.image', $plural ?? 1) }}</th>
    <td>
        @if ($image !== null)
            <img class="d-block mx-auto" src="{{ asset($image) }}"
                 alt="product image" width="160">
        @else
            <span class="d-block text-muted">@lang('messages.data.unavailable')</span>
        @endif
    </td>
</tr>