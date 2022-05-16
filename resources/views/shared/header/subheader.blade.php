{{--<div class="c-subheader px-3 m-0">--}}
{{--    <ol class="breadcrumb border-0 m-0">--}}
{{--        <li class="breadcrumb-item"><a href="/admin">@lang('pages.dashboard')</a></li>--}}
{{--        @php--}}
{{--            $segments = '';--}}
{{--        @endphp--}}
{{--        @for($i = 1; $i <= count(Request::segments()); $i++)--}}
{{--            <?php $segments .= '/' . Request::segment($i); ?>--}}
{{--            @if (Request::segment($i) === 'admin')--}}
{{--            @elseif ($i < count(Request::segments()))--}}
{{--                <li class="breadcrumb-item"><a href="/{{ Request::segment($i) }}">{{ trans('pages.'.Request::segment($i)) }}</a></li>--}}
{{--            @else--}}
{{--                <li class="breadcrumb-item active">{{ trans('pages.'.Request::segment($i)) }}</li>--}}
{{--            @endif--}}
{{--        @endfor--}}
{{--    </ol>--}}
{{--</div>--}}
