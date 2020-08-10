<div class="table">
    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        <button type="button" data-id="{{$item->id}}" data-name="{{$item->name}}" data-description="{{$item->description}}" class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#editModal">
                            Edit
                        </button>
                        <button type="button" data-id="{{$item->id}}" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="{{$item->id}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <td colspan="4" class="text-center">
                    <h4> Belum ada data</h4>
                </td>
            @endforelse
        </tbody>
    </table>
</div>