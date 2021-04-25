<div class="table-responsive">
    <table class="table" id="trainings-table">
        <thead>
            <tr>
                <th>Role</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($trainings as $training)
            <tr>
                <td>{{ $training->role->nama }}</td>
                <td>
                    <img src="{{ url('storage/'.$training->gambar) }}" alt=""
                    style="max-height: 150px; max-width: 150px;">
                </td>
                <td>{{ $training->judul }}</td>
                <td>{{ $training->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['training.destroy', $training->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('training.show', [$training->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('training.chapter.index', [$training->id]) }}" class='btn btn-default btn-xs'>
                            <i class="fa fa-list"></i>
                        </a>
                        <a href="{{ route('training.edit', [$training->id]) }}" class='btn btn-default btn-xs'>
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
