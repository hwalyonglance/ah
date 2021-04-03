<!-- Role Id Field -->
<div class="col-sm-12">
    {!! Form::label('role_id', 'Untuk:') !!}
    <p>{{ $materi->role->nama }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $materi->display_type }}</p>
</div>

<!-- Gambar Field -->
<div class="col-sm-12">
    {!! Form::label('gambar', 'Gambar:') !!}
    <p>{{ $materi->gambar }}</p>
</div>

<!-- Judul Field -->
<div class="col-sm-12">
    {!! Form::label('judul', 'Judul:') !!}
    <p>{{ $materi->judul }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $materi->keterangan }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $materi->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $materi->updated_at }}</p>
</div>

