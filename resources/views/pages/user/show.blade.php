@extends('layouts.base')

@section('title', $page_title)

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @include('partials.tr-text', ['data' => $object->GUID, 'label' => trans('fields.id'), 'tr' => 'text'])
                                    @include('partials.tr-text', ['data' => $object->name, 'label' => trans('fields.fio'), 'tr' => 'text'])
                                    @include('partials.tr-text', ['data' => $object->email, 'label' => trans('fields.email'), 'tr' => 'text'])
                                    @include('partials.tr-text', ['data' => $object->phone, 'label' => trans('fields.phone'), 'tr' => 'text'])
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="{{ route("$route.index") }}">@lang('buttons.back')</a>
                            <a class="btn btn-success" href="{{ route("$route.edit", $object->getKey()) }}">@lang('buttons.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection