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
                            <x-modal-content id="create-modal" action="/menu/element/createElement">
                                @include('pages.editmenu.__form')
                            </x-modal-content>

                            @include('pages.editmenu.__edit-modal', ['url' => "/menu/element/updateElement/"])

                            @include('partials.modal', ['url' => "/menu/element/deleteElement/"])

                            <div id="menu" data-value="{{ $menuElements->toJson() }}"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/menu-create.js') }}"></script>
    <script src="{{ asset('js/menu-edit.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection