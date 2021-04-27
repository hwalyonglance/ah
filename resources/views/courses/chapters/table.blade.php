<div class="table-responsive">
    <table class="table" id="courseChapters-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Video</th>
                <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($courseChapters as $courseChapter)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $courseChapter->judul }}</td>
                <td>
                    <iframe width="300" src="https://www.youtube.com/embed/{{ $courseChapter->video }}"
                        allowfullscreen title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                </td>
                <td>{{ $courseChapter->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['courses.chapter.destroy', $course_id, $courseChapter->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('courses.chapter.show', [$course_id, $courseChapter->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('courses.chapter.edit', [$course_id, $courseChapter->id]) }}" class='btn btn-default btn-xs'>
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
