@extends('layouts.base')

@section('title', $page_title)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quill.css') }}">
@endsection

@php($options = [
    'method'  => 'POST',
    'url'     => route("$route.store"),
])

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $page_title }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Единичная загрузка кроссов</h4>

                            {{ Form::model($object, $options) }}
                            @include("pages.$route.__form")
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-success mr-1" href="{{ route("$route.create") }}">@lang('buttons.back')</a>
                                {{ Form::submit(trans('buttons.save'), ['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}

                            <br>
                            <h4>Массовая загрузка кроссов</h4>
                            <p><a href="/storage/cross-imports/crosses-import.xlsx">Скачать шаблон</a> </p>
                            {{ Form::model($object, [ 'method'  => 'POST', "enctype" => "multipart/form-data", 'url' => route("$route.import")]) }}
                                @include("pages.$route.__formExcel")
                                <div class="d-flex justify-content-end align-items-center">
                                    <a class="btn btn-success mr-1" href="{{ route("$route.import") }}">@lang('buttons.back')</a>
                                    {{ Form::submit(trans('buttons.save'), ['class' => 'btn btn-success']) }}
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-scripts')
    <script src="{{ asset('js/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('js/vendors/quill/highlight.min.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ asset('js/src/quill.js') }}"></script>
    <script src="{{ asset('js/src/upload-image.js') }}"></script>
@endsection
