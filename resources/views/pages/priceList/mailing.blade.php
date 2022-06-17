@extends('layouts.base')
@section('title', 'Рассылки')

@php($options = [
    'method'  => 'POST',
    'url'     => route("$route.mailing"),
])

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Рассылки / <a href="{{ route('priceList.index') }}" class="text-decoration-none text-dark">Прайс листы</a></h4>
                            <span class="text-danger d-block">Фильтр Тип цены не работает! На данный момент только по оптовым ценам!</span>
                        </div>
                        <div class="card-body">
                            {{ Form::model(null, $options) }}
                            @include("pages.$route.__mailing-form")
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-dark mr-1" href="{{ route("$route.index") }}">@lang('buttons.back')</a>
                                {{ Form::submit(trans('buttons.save'), ['class' => 'btn btn-outline-dark']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
