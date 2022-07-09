@extends('admin-panel::layouts.base')

@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
{{--                @php($url = str_contains($route, '.')? str_replace('.', '/', $route): $route)--}}
{{--                @include('partials.modal', ['url' => "/$url/"])--}}
                <v-table :table="{{ $table }}">
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
{{--    <script src="{{ asset('js/src/modal.js') }}"></script>--}}
@endsection
