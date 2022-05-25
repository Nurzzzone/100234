@extends('layouts.base')

@section('title', $page_title)

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered datatable mb-3">
                                <tbody>
                                    @include('partials.tr-text', ['data' => $object->title, 'label' => trans('fields.name'), 'tr' => 'text'])
                                    @include('partials.tr-active', ['data' => $object->is_active])
                                    @include('partials.tr-active', ['data' => $object->in_footer, 'label' => trans('fields.in_footer')])
                                </tbody>
                            </table>
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @foreach($object->dropdown as $dropdown)
                                        @include('partials.tr-text', ['data' => [$dropdown->title, $dropdown->description], 'tr' => 'text-multiple'])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end align-items-center">
                            <a class="btn btn-success mr-2" href="{{ route("$route.index") }}">@lang('buttons.back')</a>
                            <a class="btn btn-success" href="{{ route("$route.edit", $object->getKey()) }}">@lang('buttons.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection