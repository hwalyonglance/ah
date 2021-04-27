<!-- Course Id Field -->
<div class="col-sm-12">
    {!! Form::label('course_id', 'Course:') !!}
    <p>{{ $courseChapter->course->title }}</p>
</div>

<!-- Judul Field -->
<div class="col-sm-12">
    {!! Form::label('judul', 'Judul:') !!}
    <p>{{ $courseChapter->judul }}</p>
</div>

<!-- Video Field -->
<div class="col-sm-12">
    {!! Form::label('video', 'Video:') !!}
    <br>
    <iframe width="400" height="250" src="https://www.youtube.com/embed/{{ $courseChapter->video }}"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $courseChapter->keterangan }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $courseChapter->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $courseChapter->updated_at }}</p>
</div>

