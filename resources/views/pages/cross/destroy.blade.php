@extends('layouts.base')

@section('title', $page_title)


@section('css')
    <link rel="stylesheet" href="{{ asset('css/quill.css') }}">
@endsection

@php($options = [
    'method'  => 'POST',
    'url'     => route("$route.delete")

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
                            <h4>Удаление пары кроссов</h4>
                            {{ Form::model($object, $options) }}
                            @include("pages.{$route}.__formDelete")
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-success mr-1"
                                   href="{{ route("{$route}.index") }}">@lang('buttons.back')</a>
                                {{ Form::submit(trans('buttons.save'), ['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}

                            <br>
                            <h4>Массовое удаление кроссов </h4>
                            {{ Form::model($object, [ 'method'  => 'POST', "enctype" => "multipart/form-data", 'url' => route("$route.import.delete")]) }}
                            @include("pages.$route.__formExcel")
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-success mr-1"
                                   href="{{ route("$route.import.delete") }}">@lang('buttons.back')</a>
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
