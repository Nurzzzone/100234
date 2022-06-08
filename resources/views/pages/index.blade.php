@extends('layouts.base')

@section('title', $page_title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <v-table :pagination-instance='{!! $objects->toJson(JSON_UNESCAPED_UNICODE) !!}'
                         :table-config='{!! $tableConfig->toJson() !!}'
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