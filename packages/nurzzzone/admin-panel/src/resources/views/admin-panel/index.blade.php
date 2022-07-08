@extends('admin-panel::layouts.base')

@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @php($url = str_contains($route, '.')? str_replace('.', '/', $route): $route)
                @include('partials.modal', ['url' => "/$url/"])
                <v-table :objects='{!! $objects->toJson(JSON_UNESCAPED_UNICODE) !!}'
                         :column='{!! json_encode($columns, JSON_UNESCAPED_UNICODE) !!}'
                         :tools='{!! json_encode($tools, JSON_UNESCAPED_UNICODE) !!}'
                         :filters='{!! json_encode($tools, JSON_UNESCAPED_UNICODE) !!}'
                         hover="{{ $objects->isNotEmpty() }}">
                    <template v-slot="props">
                        <v-table-head></v-table-head>
                        <v-table-body :objects="props.objects"></v-table-body>
                    </template>
                </v-table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/src/modal.js') }}"></script>
@endsection
