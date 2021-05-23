<div class="table-responsive">
    <table class="table" id="roles-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->nama }}</td>
                <td>{{ $role->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('roles.show', [$role->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('roles.edit', [$role->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-danger btn-xs"
                            {{ $role->id <= 6 ? 'disabled':'' }}
                            onclick="return confirm('Are you sure?')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
