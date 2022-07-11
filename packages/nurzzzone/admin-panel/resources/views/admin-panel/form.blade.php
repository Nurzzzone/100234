@extends('admin-panel::layouts.base')

@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <v-form :form="{{ $form }}"></v-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
