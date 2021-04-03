<!-- Materi Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('materi_id', 'Materi Id:') !!}
    {!! Form::select('materi_id', [1=>1,2=>2], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Video Field -->
<div class="form-group col-sm-6">
    {!! Form::label('video', 'Video:') !!}
    {!! Form::text('video', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>
