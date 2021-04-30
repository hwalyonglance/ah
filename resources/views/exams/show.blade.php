@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam Details</h1>
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
                    @foreach ($questions as $question)
                        <p>{{ $loop->iteration }}. {{ $question->question }}</p>
                        @foreach ($question->options as $option)
                            <label class='ml-4 font-weight-normal'>
                                <input type="radio" name="answer[{{ $question->id }}]">
                                {{ $letterByIndex[$loop->index] }}. {{ $option->option }}
                            </label>
                            <br>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
