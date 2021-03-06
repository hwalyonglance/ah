<div class="table-responsive">
    <table class="table" id="questions-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Options</th>
                <th>Answer</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $question->question }}</td>
                <td>{{ $question->options->count() ?? 0 }}</td>
                <td>{{ optional($question->answer)->option }}</td>
                <td width="120">
                    {!! Form::open(['url' => route('exams.questions.destroy',[$exam_id,$question->id]), 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('exams.questions.show', [$exam_id,$question->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('exams.questions.options.index', ['exam'=>$exam_id,'question'=>$question->id]) }}" class='btn btn-default btn-xs'>
                            <i class="fa fa-list"></i>
                        </a>
                        <a href="{{ route('exams.questions.edit', [$exam_id,$question->id]) }}" class='btn btn-default btn-xs'>
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
