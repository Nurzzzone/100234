@extends('layouts.auth')

@section('title', trans('pages.authorization'))

@section('content')
    <div class="container">
        @include('partials.validation')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-title">
                            <h3 class="text-center m-0 ml-4">@lang('pages.authorization')</h3>
                        </div>
                        <div class="card-body">
                            {{ Form::model(null, ['method' => 'POST', 'url' => route('login')]) }}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                        </svg>
                                    </span>
                                </div>
                                {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('fields.email'), 'required' => '', 'autofocus' => '']) }}
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                                        </svg>
                                    </span>
                                </div>
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('fields.password'), 'required' => '']) }}
                            </div>
                            <div class="d-flex align-items-center justify-content-end">
                                {{ Form::button(trans('buttons.login'), ['class' => 'btn btn-dark px-4', 'type' => 'submit']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
