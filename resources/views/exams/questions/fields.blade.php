<!-- Exam Id Field -->
<input type="hidden" name="exam_id" value='{{ $exam_id }}'>

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'form-control']) !!}
</div>
