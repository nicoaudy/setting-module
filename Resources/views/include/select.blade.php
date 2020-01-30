<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	{!! Form::label($title ?? $name) !!}
	{!! Form::select($name, $options, $value ?? null, [
		'class' => ($errors->has($name)) ? 'form-control is-invalid select2' : 'form-control select2',
		'id' => $id ?? null,
	]) !!}
	{!! $errors->first($name, '<div class="invalid-feedback d-block">:message</div>') !!}
</div>
