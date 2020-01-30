<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	{!! Form::label($title ?? $name) !!}
	{!! Form::textarea($name, $value ?? null, [
		'class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control',
		'placeholder' => $placeholder ?? null,
		'style' => 'height: 150px'
	]) !!}
	{!! $errors->first($name, '<div class="invalid-feedback d-block">:message</div>') !!}
</div>
