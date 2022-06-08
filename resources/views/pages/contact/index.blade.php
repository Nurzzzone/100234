@extends('layouts.base')

@section('title', $page_title)

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include("pages.$route.__table")
                            @php($url = str_contains($route, '.')? str_replace('.', '/', $route): $route)
                        </div>
                        <div class="card-footer">{{ $objects->links('shared.pagination', ['paginator' => $objects]) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/src/table-row.js') }}"></script>
    <script src="{{ asset('js/map-form.min.js') }}"></script>
@endsection