<tr>
    <th class="align-start">
        <span class="mt-2 d-inline-block">{{ trans_choice($locale, $plural ?? 1)}}</span>
    </th>
    <td>
        @forelse ($items as $index => $item)
            <div class="custom-checkbox d-block">
                @php
                    $options = [
                        'id' => Str::slug($item),
                        'class' => 'form-check-input'
                    ];
                @endphp
                {{ Form::checkbox($field.'[]', $index, isset($chosen)? $chosen->contains($index): false, $options) }}
                {{ Form::label(Str::slug($item), $item, ['class' => 'd-flex align-items-center']) }}
            </div>
        @empty
            <span class="text-muted">{{ trans('messages.tags.unavailable') }}</span>
        @endforelse
    </td>
</tr>