@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Halaman index Coba Crud</h3>
            <button type="button" class="btn btn-success pd-5" style="float: right" data-toggle="modal" data-target="#createModal">
                Create
            </button>

            @include('layout.error-alert')

        </div>
        <div class="col-12">
            @include('coba-crud.components.content')
        </div>
    </div>
    @include('coba-crud.components.modal-create')
    @include('coba-crud.components.modal-edit')
    @include('coba-crud.components.modal-delete')
@endsection
@include('coba-crud.components.js.index-js')