<tr>
    <th class="align-start">
        <span class="mt-2 d-inline-block">@lang($locale ?? 'fields.description') {{ $index ?? null }}</span>
        <small class="text-muted d-block mt-2">@lang('messages.textarea.linebreak')</small>
    </th>
    <td>
        {{ Form::hidden($field, null, ['data-name' => 'editorTarget', 'data-value' => $current_value ?? old($field)]) }}
        <div data-name="editor" data-placeholder="{{ trans($locale ?? 'fields.description') }}"></div>
    </td>
</tr>
