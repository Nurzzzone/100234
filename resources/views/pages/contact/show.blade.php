@extends('layouts.base')

@section('title', trans('pages.pages'))

@section('header-scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered datatable mb-4">
                                <tbody>
                                    @include('partials.tr-text', ['data' => $object->business_region, 'label' => trans('fields.business_region'), 'tr' => 'text'])
                                    @include('partials.tr-text', ['data' => $object->address, 'label' => trans('fields.address'), 'tr' => 'text'])
                                    @include('partials.tr-text', ['data' => $object->email, 'label' => trans('fields.email'), 'tr' => 'text'])
                                </tbody>
                            </table>

                            <table class="table table-striped table-bordered datatable mb-4">
                                <tbody>
                                    @foreach($object->phones as $child)
                                        @include('partials.tr-text', ['data' => $child->phone, 'label' => $child->type, 'tr' => 'text'])
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table table-striped table-bordered datatable mb-4">
                                <tbody>
                                    @foreach($object->schedules as $child)
                                        @include('partials.tr-text', ['data' => "$child->start-$child->end", 'label' => $child->type, 'tr' => 'text'])
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @include('partials.tr-map', ['data' => ['latitude' => $object->latitude, 'longitude' => $object->longitude]])
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="{{ route("$route.index") }}">@lang('buttons.back')</a>
                            <a class="btn btn-success" href="{{ route("$route.edit", $object->GUID) }}">@lang('buttons.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/src/map-show.js') }}"></script>
@endsection