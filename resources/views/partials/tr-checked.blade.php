<tr>
    <th class="align-middle">{{ trans_choice($locale, $plural ?? 1) }}</th>
    <td>
        @forelse ($data as $item)
            <span>{{ $item->name }}</span>
        @empty
            <span class="text-muted">{{ trans('messages.info.unavailable') }}</span>
        @endforelse
    </td>
</tr>