<div class="table-responsive">
    <table class="table" id="exams-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Role</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Questions</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($exams as $exam)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $exam->role->nama }}</td>
                <td>
                    <img src="{{ url('storage/'.$exam->image_url) }}" alt=""
                    style="max-height: 150px; max-width: 150px;">
                </td>
                <td>{{ $exam->title }}</td>
                <td>{{ $exam->description }}</td>
                <td>{{ $exam->questions->count() ?? 0 }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['exams.destroy', $exam->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('exams.show', [$exam->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        @if($user->is_admin)
                            <a href="{{ route('exams.questions.index', [$exam->id]) }}" class='btn btn-default btn-xs'>
                                <i class="fa fa-list"></i>
                            </a>
                            <a href="{{ route('exams.edit', [$exam->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            @if (!$exam->taker->count())
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endif
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
