@extends('layouts.base')

@section('title', 'Меню')

@section('header-scripts')
    <script src="https://cdn.jsdelivr.net/npm/nested-sort@5.1.0/dist/nested-sort.umd.min.js"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-end">
                            <x-modal-content-button class="btn-success" for="create-modal" value="{{ trans('buttons.create') }}"></x-modal-content-button>
                        </div>

                        <div class="card-body">
                            <x-modal-content id="create-modal" action="/menu">
                                @include('pages.menu.__form')
                            </x-modal-content>

                            @include('pages.menu.__edit-modal', ['url' => "/menu/"])

                            @include('partials.modal', ['url' => "/menu/"])

                            <div id="menu" data-value="{{ $menuElements->toJson() }}"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/src/menu.js') }}"></script>
    <script src="{{ asset('js/src/menu-create.js') }}"></script>
    <script src="{{ asset('js/src/menu-edit.js') }}"></script>
    <script src="{{ asset('js/src/modal.js') }}"></script>
@endsection