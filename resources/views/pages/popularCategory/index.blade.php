@extends('layouts.base')

@section('title', $page_title)

@section('header-scripts')
    <style type="text/css">
        table th, table td
        {
            width: 100px;
            padding: 5px;
            border: 1px solid #ccc;
        }
        .selected
        {
            background-color: #666;
            color: #fff;
        }

        .ui-sortable-helper {
            display: table;
            table-layout: fixed;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($objects->count() < 5)
                            <div class="card-header d-flex justify-content-end">
                                <a class="btn btn-success" href="{{ route("$route.create") }}">@lang('buttons.create')</a>
                            </div>
                        @endif
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
    <script src="{{ asset('js/table-row.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function () {
            const table = $('#sortable-table');
            let sequence = [];


            $("#sortable-table").sortable({
                items: 'tr',
                cursor: 'pointer',
                dropOnEmpty: false,
                update: function() {
                    let items = $(table).find('tbody').find('tr');

                    items.each(function(key, item) {
                        sequence.push({
                            id: $(item).data('id'),
                            sequence: key + 1
                        });
                    });

                    $.ajax({
                        url: $('#sortable-table').data('update-sequence-url'),
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { sequence: sequence },
                    });
                }
            })
        });
    </script>
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection