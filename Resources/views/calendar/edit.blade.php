@extends('setting::layouts.master')

@section('setting::title', 'Edit Calendar')

@section('setting::breadcrumb-2')
	@include('setting::include.breadcrumb', [
		'title' => 'Calendar',
		'active' => true,
		'url' => route('setting.calendar.index')
	])
@endsection

@section('setting::breadcrumb-3')
	@include('setting::include.breadcrumb', [
		'title' => 'Edit Calendar',
		'active' => false,
	])
@endsection

@section('setting::content')
<div class="row">
	<div class="col-12">

		@include('flash::message')

		@include('include.error-list')

		<div class="card">
			<div class="card-header">
				<h4>Form</h4>
				<div class="card-header-form">
					<a href="{{ route('setting.calendar.index') }}" class="btn btn-warning">
						<i class="fa fa-arrow-left"></i> Back
					</a>
				</div>
			</div>

			{!! Form::open([
				'method' => 'PATCH',
				'route' => ['setting.calendar.update', $row->id],
				'onsubmit' => "submitButton.disabled = true"
			]) !!}
			<div class="card-body p-4">
				<div class="row">
					<div class="col-md-6">
						@include('setting::include.input', [
							'type' => 'text',
							'name' => 'user_type_id',
							'title' => 'User Type',
							'disabled' => true,
							'value' => $row->userType->name,
						])
					</div>
					<div class="col-md-6">
						@include('setting::include.input', [
							'type' => 'date',
							'name' => 'date',
							'disabled' => true,
							'value' => $row->date,
						])
					</div>
					<div class="col-md-6">
						@include('setting::include.input', [
							'type' => 'text',
							'name' => 'days_of_week',
							'disabled' => true,
							'value' => $row->days_of_week,
						])
					</div>
					<div class="col-md-6">
						@include('setting::include.select', [
							'name' => 'is_working_day',
							'value' => $row->is_working_day,
							'options' => [
								0 => 'No',
								1 => 'Yes'
							]
						])
					</div>
					<div class="col-md-6">
						@include('setting::include.input', [
							'type' => 'text',
							'name' => 'start_working_time',
							'value' => $row->start_working_time,
						])
					</div>
					<div class="col-md-6">
						@include('setting::include.input', [
							'type' => 'text',
							'name' => 'end_working_time',
							'value' => $row->end_working_time,
						])
					</div>
					<div class="col-md-12">
						@include('setting::include.textarea', [
							'name' => 'description',
							'value' => $row->description,
						])
					</div>
				</div>
			</div>
			@include('setting::include.button')
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
