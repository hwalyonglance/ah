<div class="table-responsive">
    <table class="table" id="materiBabs-table">
        <thead>
            <tr>
                <th>Materi Id</th>
        <th>Video</th>
        <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($materiBabs as $materiBab)
            <tr>
                <td>{{ $materiBab->materi_id }}</td>
            <td>{{ $materiBab->video }}</td>
            <td>{{ $materiBab->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['materiBabs.destroy', $materiBab->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('materiBabs.show', [$materiBab->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('materiBabs.edit', [$materiBab->id]) }}" class='btn btn-default btn-xs'>
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
