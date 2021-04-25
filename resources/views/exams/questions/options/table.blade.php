<div class="table-responsive">
    <table class="table" id="questionOptions-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Option</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questionOptions as $questionOption)
            <tr>
                <td>{{ $loop->iteration }}</td>
            <td>{{ $questionOption->option }}</td>
                <td width="120">
                    {!! Form::open(['url' => 'exams/'.$exam->id.'/questions/'.$question->id.'/options/'.$questionOption->id, 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('exams.questions.options.show', ['exam'=>$exam->id,'question'=>$question->id,'option'=>$questionOption->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('exams.questions.options.edit', ['exam'=>$exam->id,'question'=>$question->id,'option'=>$questionOption->id]) }}" class='btn btn-default btn-xs'>
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
