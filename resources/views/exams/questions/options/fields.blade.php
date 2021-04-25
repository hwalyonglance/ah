<!-- Question Id Field -->
<input type="hidden" name="question_id" value='{{ $exam_id }}'>


<!-- Option Field -->
<div class="form-group col-sm-6">
    {!! Form::label('option', 'Option:') !!}
    {!! Form::text('option', null, ['class' => 'form-control']) !!}
</div>
