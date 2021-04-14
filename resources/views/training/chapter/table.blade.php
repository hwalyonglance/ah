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
        @foreach($trainingChapters as $trainingChapter)
            <tr>
                <td>
                    {{ $trainingChapter->judul }}
                </td>
                <td>
                    <iframe width="300" src="https://www.youtube.com/embed/{{ $trainingChapter->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </td>
                <td>{{ $trainingChapter->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['training.chapter.destroy', $training_id, $trainingChapter->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('training.chapter.show', [$training_id, $trainingChapter->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('training.chapter.edit', [$training_id, $trainingChapter->id]) }}" class='btn btn-default btn-xs'>
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
