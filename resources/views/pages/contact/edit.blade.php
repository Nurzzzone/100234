@extends('layouts.base')

@section('title', $page_title)

@section('css')
    <link href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection

@php($options = [
    'method'  => 'PUT',
    'url'     => route("$route.update", $object->GUID)
])

@section('header-scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            @include('partials.flash-message')
            <div class="row">
                @include('partials.validation')
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $page_title }}</h4>
                        </div>
                        <div class="card-body">
                            {{ Form::model($object, $options) }}
                                @include("pages.$route.__form")
                                <div class="d-flex justify-content-end align-items-center">
                                    <a class="btn btn-success mr-1" href="{{ route("$route.index") }}">@lang('buttons.back')</a>
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
    <script src="{{ asset('js/quill.min.js') }}"></script>
    <script src="{{ asset('js/map-form.min.js') }}"></script>
@endsection