<!-- Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Training Untuk:') !!}
    {!! Form::select('role_id', $roles, null, ['class' => 'form-control custom-select', 'required'=>'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'required'=>'required']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    <input class="form-control" type="password" name="password" {{ isset($user)?'':'required' }} id="password" value="{{ '' }}">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Password Confirmation:') !!}
    <input class="form-control" type="password" name="password_confirmation" {{ isset($user)?'':'required' }}>
</div>
