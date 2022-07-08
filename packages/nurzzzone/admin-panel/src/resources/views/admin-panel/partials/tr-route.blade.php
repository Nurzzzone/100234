@if (isset($childs))
    <tr>
        <td class="p-0">
            <div class="pages__dropdown-item pointer-cursor d-flex justify-content-between align-items-center p-3"
                data-toggle="collapse" 
                data-target="#{{ Str::slug($name) }}" type="button">
                <span>{{ __($name) }}</span>
                <span>&xrarr;</span>
            </div>
            <div id="{{ Str::slug($name) }}" class="collapse">
                @foreach ($childs as $child)
                <a class="border-top pages__dropdown-item btn d-flex justify-content-between align-items-center pl-4 pr-3 py-3" href="{{ $child['route'] }}">
                    <span class="pl-4">{{ __($child['name']) }}</span>
                    <span>&xrarr;</span>
                </a>
                @endforeach
            </div>
        </td>
    </tr>
@else
    <tr data-name="tableRow" data-href="{{ $route }}">
        <td class="p-0" @isset($colspan) colspan="{{$colspan}}" @endisset>
            <div class="pages__dropdown-item d-flex justify-content-between align-items-center p-3">
                <span>{{ $name }}</span>
                <span>&xrarr;</span>
            </div>
        </td>
    </tr>
@endif