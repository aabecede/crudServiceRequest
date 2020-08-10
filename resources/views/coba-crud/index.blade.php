@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Halaman index Coba Crud</h3>
            <button type="button" class="btn btn-success pd-5" style="float: right" data-toggle="modal" data-target="#createModal">
                Create
            </button>

            @if (session('warning'))
                {!! Helper::warning_alert(session('warning')) !!}
            @endif

            @if (session('success'))
                {!! Helper::success_alert(session('success')) !!}
            @endif

            @if (session('error'))
                {!! Helper::error_alert(session('error')) !!}
            @endif

        </div>
        <div class="col-12">
            @include('coba-crud.components.content')
        </div>
    </div>
    @include('coba-crud.components.modal-create')
    @include('coba-crud.components.modal-edit')
    @include('coba-crud.components.modal-delete')
@endsection
@push('js')
    <script>
        $('.btn-edit').on('click', function(){
            id          = $(this).data('id')
            name        = $(this).data('name')
            description = $(this).data('description')
            console.log(id,name,description)
            $('#edit-id').val(id)
            $('#edit-name').val(name)
            $('#edit-description').val(description)
        })

        $('.btn-delete').on('click', function(){
            id = $(this).data('id')
            urll = '{{url('alamat/delete')}}' + '/' + id
            $('#frmDelete').attr('action', urll)
        })
    </script>
@endpush