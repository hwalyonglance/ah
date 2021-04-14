<!-- Training Id Field -->
<div class="col-sm-12">
    {!! Form::label('training_id', 'Training:') !!}
    <p>{{ $training->judul ?? '' }}</p>
</div>

<!-- Judul Field -->
<div class="col-sm-12">
    {!! Form::label('judul', 'Judul Bab:') !!}
    <p>{{ $trainingChapter->judul }}</p>
</div>

<!-- Video Field -->
<div class="col-sm-12">
    {!! Form::label('video', 'Video:') !!}
    <br>
    <iframe width="400" height="250" src="https://www.youtube.com/embed/{{ $trainingChapter->video }}"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $trainingChapter->keterangan }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $trainingChapter->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $trainingChapter->updated_at }}</p>
</div>

