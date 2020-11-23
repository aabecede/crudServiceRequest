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