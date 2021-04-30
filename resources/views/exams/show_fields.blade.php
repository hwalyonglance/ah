<!-- Role Id Field -->
<div class="col-sm-12">
    {!! Form::label('role_id', 'Role:') !!}
    <p>{{ $exam->role->nama }}</p>
</div>

<!-- Image Url Field -->
<div class="col-sm-12">
    {!! Form::label('image_url', 'Image Url:') !!}
    <br>
    <img src="{{ url('storage/'.$exam->image_url) }}" alt=""
        style="max-height: 150px; max-width: 150px;">
    <br><br>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $exam->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $exam->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $exam->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $exam->updated_at }}</p>
</div>

