@extends('layouts.base')

@section('title', $page_title)

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
                            <h4>Прайс листы / <a href="{{ route('priceList.mailingList') }}" class="text-decoration-none text-dark">Рассылки</a></h4>
                            <span class="text-danger d-block">Фильтр Тип цены не работает! На данный момент только по оптовым ценам!</span>
                        </div>
                        <div class="card-body">
                            {{ Form::model(null, $options) }}
                            @include("pages.$route.__form")
                            <div class="d-flex justify-content-end align-items-center">
                                {{ Form::submit('Скачать', ['class' => 'btn btn-outline-dark']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#price-groups').hide();
            $('#price-list-type').val('0');

            $('select[name="priceListType"]').first().change(function() {
                $('#manufacturers').toggle();
                $('#price-groups').toggle();
            });
        });
    </script>
@endsection
