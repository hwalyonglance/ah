{{-- {{ dd($examTaken->score) }} --}}

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam {{ $user->is_admin ? 'Details':'' }}</h1>
                    <br>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('exams.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('flash::message')

    <div class="content px-3">
        <h4>Nama Ujian</h4>
        <p >{{ $exam->title }}</p>
        @if ($examTaken->status)
            <h4>Nilai</h4>
            <p >{{ $examTaken->score }}</p>
        @endif
    </div>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                @if ($user->is_admin)
                    <div class="row">
                        @include('exams.show_fields')
                    </div>
                @else
                    @php
                        $letterByIndex = [
                            'A',
                            'B',
                            'C',
                            'D',
                        ];
                    @endphp
                    @if ($examTaken->status)
                        @foreach ($questions as $question)
                            <p>{{ $loop->iteration }}. {{ $question->question }}</p>
                            @php
                                $letterByOptionId = [];
                                $optionsById = [];
                            @endphp
                            @foreach ($question->options as $option)
                                @php
                                    $optionsById[$option->id] = $option;
                                @endphp
                                <label class='ml-4 font-weight-normal'>
                                    @php
                                        $letterByOptionId[$option->id] = $letterByIndex[$loop->index];
                                    @endphp
                                    {{ $letterByIndex[$loop->index] }}. {{ $option->option }}
                                </label>
                                <br>
                            @endforeach
                            <p class='ml-4 font-weight-normal'>
                                Jawaban Anda <b>{{ $userAnswers[$question->id] == $question->answer->id ? 'Benar':'Salah' }}</b>:
                                {{ $letterByOptionId[$userAnswers[$question->id]] }}.
                                {{ $optionsById[$userAnswers[$question->id]]->option }}
                            </p>
                        @endforeach
                    @else
                        {!! Form::open(['url' => url('exams/'.$exam->id.'/submit')]) !!}
                            @foreach ($questions as $question)
                                <p>{{ $loop->iteration }}. {{ $question->question }}</p>
                                @foreach ($question->options as $option)
                                    <label class='ml-4 font-weight-normal'>
                                        <input type="radio" name="answer[{{ $question->id }}]" value="{{ $option->id }}" required>
                                        {{ $letterByIndex[$loop->index] }}. {{ $option->option }}
                                    </label>
                                    <br>
                                @endforeach
                            @endforeach
                            <input class="btn btn-primary mt-4" type="submit" value="Submit">
                        {!! Form::close() !!}
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
