
<div class="table-responsive">
    <table class="table" id="courses-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Role</th>
                <th>Category</th>
                <th>Gambar</th>
                <th>Title</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $course->role->nama }}</td>
                <td>{{ $course->category->name }}</td>
                <td>
                    <img src="{{ url('storage/'.$course->gambar) }}" alt=""
                    style="max-height: 150px; max-width: 150px;">
                </td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('courses.show', [$course->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        @if($user->is_trainer)
                            <a href="{{ route('courses.chapter.index', [$course->id]) }}" class='btn btn-default btn-xs'>
                                <i class="fa fa-list"></i>
                            </a>
                            <a href="{{ route('courses.edit', [$course->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
