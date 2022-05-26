@extends('layouts.base')

@section('title', $page_title)

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <a class="btn btn-success" href="{{ route("$route.create") }}">@lang('buttons.create')</a>
                        </div>
                        <div class="card-body">
                            @include("pages.$route.__table")
                            @php($url = str_contains($route, '.')? str_replace('.', '/', $route): $route)
                            @include('partials.modal', ['url' => "/$url/"])
                        </div>
                        <div class="card-footer">{{ $objects->links('shared.pagination', ['paginator' => $objects]) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/table-row.min.js') }}"></script>
    <script src="{{ asset('js/modal.min.js') }}"></script>
@endsection