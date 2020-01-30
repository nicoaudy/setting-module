<div class="card-body p-4">
	<div class="row">
		<div class="col-md-6">
			@include('setting::include.input', [
				'type' => 'text',
				'name' => 'name',
				'placeholder' => 'Enter Your name'
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.input', [
				'type' => 'text',
				'name' => 'username',
				'placeholder' => 'Enter Your Username (unique)',
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.input', [
				'type' => 'email',
				'name' => 'email',
				'placeholder' => 'Enter Your Email (unique)',
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.input', [
				'type' => 'password',
				'name' => 'password',
				'placeholder' => 'Enter your password',
				'disabled' => isset($row) ? true : false
			])
		</div>

		<div class="card-header">
			<h4>Roles & Permission</h4>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				@foreach ($roles as $role)
					@isset($row)
						{{ Form::checkbox('roles[]',  $role->id, $row->roles ) }} {{ ucfirst($role->name) }}
				@else
						{{ Form::checkbox('roles[]',  $role->id ) }} {{ ucfirst($role->name) }}
					@endif
				@endforeach
			</div>
		</div>

		<div class="col-md-12">
			@include('setting::include.select', [
				'name' => 'user_type_id',
				'title' => 'User Type',
				'options' => $types->pluck('name', 'id')
			])
		</div>

		@if(!isset($row))
		<div class="card-header">
			<h4>Profile</h4>
		</div>

		<div class="col-md-12">
			@include('setting::include.select', [
				'name' => 'gender',
				'options' => [
					'' => 'Please Select',
					'0' => 'Female',
					'1' => 'Male'
				]
			])
		</div>
		@endisset
	</div>
</div>
@include('setting::include.button')
