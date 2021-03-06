@extends('layouts.app')

@php
    $user = auth()->user();
@endphp

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exams</h1>
                </div>
                <div class="col-sm-6">
                    @if($user->is_trainer)
                        <a class="btn btn-primary float-right"
                        href="{{ route('exams.create') }}">
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

        @if($user->is_trainer)
            <div class="card">
                <div class="card-body p-0">
                    @include('exams.table')
                    <div class="card-footer clearfix float-right">
                        <div class="float-right">
                        </div>
                    </div>
                </div>
            </div>
        @else
            @include('exams.card')
        @endif
    </div>

@endsection

