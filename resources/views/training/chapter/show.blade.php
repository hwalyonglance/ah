@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Training Bab Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ $user->is_admin ? route('training.chapter.index', $trainingChapter->id) : route('training.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @if ($user->is_admin)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('training.chapter.show_fields')
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-3">
                    <ul class="list-group">
                        @foreach($chapters as $chapter)
                            <li class="list-group-item">
                                {{ $loop->iteration }}.
                                <a href="{{ url('training/'.$chapter->training_id.'/chapter/'.$chapter->id) }}">{{ $chapter->judul }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-9">
                    <iframe src="https://www.youtube.com/embed/{{ $chapter->video }}"
                        allowfullscreen frameborder="0" height='450px' title=""  width="100%"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                </div>
            </div>
        @endif
    </div>
@endsection
