@include('include.error-list')
<div class="card-body p-4">
	<div class="row">
		<div class="col-md-6">
			@include('setting::include.select', [
				'name' => 'division_id',
				'title' => 'Division',
				'options' => $divisions->pluck('name', 'id'),
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.select', [
				'name' => 'department_id',
				'title' => 'Department',
				'options' => $departments->pluck('name', 'id')
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.radio', [
				'name' => 'type',
				'falsyTitle' => 'Employee',
				'truthyTitle' => 'Role',
				'falsyId' => 'employee',
				'truthyId' => 'role',
			])
		</div>
		<div class="col-md-6" style="display: none" id="1">
			<div class="form-group {{ $errors->has('approver_id') ? 'has-error' : '' }}">
				{!! Form::label('Employees') !!} <br>
				<select class="form-control select2" name="approver_id">
					<option value="">Please Select</option>
					@foreach ($employees as $item)
						<option value="{{ $item->id }}" {{ isset($row) ? ($row->approver_id == $item->id ? 'selected' : null) : (old('approver_id') == $item->id ? 'selected' : null) }}>
							{{ $item->name }}
						</option>
					@endforeach
				</select>
				{!! $errors->first('approver_id', '<div class="invalid-feedback d-block">:message</div>') !!}
			</div>
		</div>
		<div class="col-md-6" style="display:none" id="2">
			<div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
				{!! Form::label('Roles') !!}
				<select class="form-control select2" name="role">
					<option value="">Please Select</option>
					@foreach ($roles as $item)
						<option value="{{ $item->name }}"
			  {{ isset($row) ?
				  ($row->role == $item->name ? 'selected' : null) :
			  (old('role') == $item->name ? 'selected' : null) }}>
						  {{ $item->name }}
						</option>
					@endforeach
				</select>
				{!! $errors->first('role', '<div class="invalid-feedback d-block">:message</div>') !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group {{ $errors->has('application_name') ? 'has-error' : '' }}">
				{!! Form::label('Application Name') !!}
				<select class="form-control select2" name="application_name">
					<option value="">Please Select</option>
					@foreach ($apps as $item)
						<option value="{{ $item }}" {{ isset($row) ?  ($row->application_name == $item ? 'selected' : null) : (old('application_name') == $item ? 'selected' : null) }}>
						  {{ $item }}
						</option>
					@endforeach
				</select>
				{!! $errors->first('application_name', '<div class="invalid-feedback d-block">:message</div>') !!}
			</div>
		</div>
		<div class="col-md-6">
			@include('setting::include.input', [
				'type' => 'number',
				'name' => 'sequence',
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.input', [
				'type' => 'text',
				'name' => 'approval_caption',
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.radio', [
				'name' => 'back_to_requestor',
				'falsyTitle' => 'False',
				'truthyTitle' => 'True',
			])
		</div>
		<div class="col-md-6">
			@include('setting::include.textarea', [
				'name' => 'description',
			])
		</div>
	</div>
</div>
@include('setting::include.button')
