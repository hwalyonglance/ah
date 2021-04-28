<div class="table-responsive">
    <table class="table" id="questionOptions-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Pilihan</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questionOptions as $questionOption)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $questionOption->option }}</td>
                <td>{{ $questionOption->status ? 'Benar': '' }}</td>
                <td width="120">
                    <div class='btn-group'>
                        {!! Form::open([
                            'url' => 'exams/'.$exam->id.'/questions/'.$question->id.'/options/'.$questionOption->id.'/set-correct',
                            'method' => 'patch'
                        ]) !!}
                        <button type="submit" class="btn btn-primary btn-xs" {{ $questionOption->status ? 'disabled':'' }}
                            onclick="return confirm('Are you sure?')"><i class="fa fa-check"></i></button>
                        {!! Form::close() !!}
                        <a href="{{ route('exams.questions.options.show', ['exam'=>$exam->id,'question'=>$question->id,'option'=>$questionOption->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('exams.questions.options.edit', ['exam'=>$exam->id,'question'=>$question->id,'option'=>$questionOption->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::open([
                            'url' => 'exams/'.$exam->id.'/questions/'.$question->id.'/options/'.$questionOption->id,
                            'method' => 'delete'
                        ]) !!}
                        <button type="submit"
                            class="btn btn-danger btn-xs" {{ $questionOption->status ? 'disabled':'' }} onclick="return confirm('Are you sure?')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
