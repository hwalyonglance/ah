<!-- Question Id Field -->
<div class="col-sm-12">
    {!! Form::label('question_id', 'Question:') !!}
    <p>{{ $questionOption->question->question }}</p>
</div>

<!-- Option Field -->
<div class="col-sm-12">
    {!! Form::label('option', 'Option:') !!}
    <p>{{ $questionOption->option }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $questionOption->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $questionOption->updated_at }}</p>
</div>

