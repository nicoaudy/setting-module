<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	{!! Form::label($title ?? $name) !!}
	@if($type == 'password')
	{!! Form::password($name, [
		'class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control',
		'placeholder' => $placeholder ?? null,
		'disabled' => $disabled ?? false
	]) !!}
	@else
	{!! Form::$type($name, $value ?? null, [
		'class' => ($errors->has($name))
					? 'form-control is-invalid' . ($type == 'date' ? ' datepicker' : null)
					: 'form-control' . ($type == 'date' ? ' datepicker' : null),
		'placeholder' => $placeholder ?? null,
		'disabled' => $disabled ?? false
	]) !!}
	@endif
	{!! $errors->first($name, '<div class="invalid-feedback d-block">:message</div>') !!}
</div>
