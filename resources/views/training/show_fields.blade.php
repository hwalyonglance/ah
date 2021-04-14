<!-- Gambar Field -->
<div class="col-sm-12 col-lg-6">
    {!! Form::label('gambar', 'Gambar:') !!}
    <p>{{ $training->gambar }}</p>
</div>

<!-- Role Id Field -->
<div class="col-sm-12 col-lg-6">
    {!! Form::label('role_id', 'Untuk:') !!}
    <p>{{ $training->role->nama }}</p>
</div>

<!-- Judul Field -->
<div class="col-sm-12 col-lg-6">
    {!! Form::label('judul', 'Judul:') !!}
    <p>{{ $training->judul }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12 col-lg-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $training->keterangan }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12 col-lg-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $training->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12 col-lg-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $training->updated_at }}</p>
</div>

