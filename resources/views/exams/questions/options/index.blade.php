@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Question Options</h1>
                    <br>
                    <p>{{ $question->question }}</p>
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-default"
                        href="{{ route('exams.questions.index', ['exam'=>$exam->id]) }}">
                        Back
                    </a>
                    @if (count($questionOptions) < 4)
                        <a class="btn btn-primary"
                            href="{{ route('exams.questions.options.create', ['exam'=>$exam->id,'question'=>$question->id]) }}">
                            Add New
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('exams.questions.options.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

