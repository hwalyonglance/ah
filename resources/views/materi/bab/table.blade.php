{{-- {{ dd($materi) }} --}}
{{-- @include('materi.show_fields') --}}

<div class="table-responsive">
    <table class="table" id="materiBabs-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Video</th>
                <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($materiBabs as $materiBab)
            <tr>
                <td>
                    {{ $materiBab->judul }}
                </td>
                <td>
                    <iframe width="300" src="https://www.youtube.com/embed/{{ $materiBab->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </td>
                <td>{{ $materiBab->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['materi.bab.destroy', $materi_id, $materiBab->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('materi.bab.show', [$materi_id, $materiBab->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('materi.bab.edit', [$materi_id, $materiBab->id]) }}" class='btn btn-default btn-xs'>
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
