<div class="table-responsive">
    <table class="table" id="materis-table">
        <thead>
            <tr>
                <th>Role</th>
        <th>Type</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($materis as $materi)
            <tr>
                <td>{{ $materi->role->nama }}</td>
            <td>{{ $materi->display_type }}</td>
            <td>{{ $materi->gambar }}</td>
            <td>{{ $materi->judul }}</td>
            <td>{{ $materi->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['materi.destroy', $materi->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('materi.show', [$materi->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('materi.edit', [$materi->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
