@extends('setting::layouts.master')

@section('setting::title', 'Generate Calendar')

@section('setting::breadcrumb-2')
	@include('setting::include.breadcrumb', [
		'title' => 'Calendar',
		'active' => true,
		'url' => route('setting.calendar.index')
	])
@endsection

@section('setting::breadcrumb-3')
	@include('setting::include.breadcrumb', [
		'title' => 'Generate Calendar',
		'active' => false,
	])
@endsection

@section('setting::content')
<div class="row">
	<div class="col-12">

		@include('flash::message')

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
				'route' => 'setting.calendar.store',
				'onsubmit' => "submitButton.disabled = true"
			]) !!}
			<div class="card-body p-4">
				<div class="row">
					<div class="col-md-12">
						@include('setting::include.select', [
							'name' => 'user_type_id',
							'title' => 'User Type',
							'options' => $types->pluck('name', 'id')
						])
					</div>
					<div class="col-md-12">
						@include('setting::include.input', [
							'type' => 'text',
							'name' => 'from',
							'placeholder' => now()->format('Y')
						])
					</div>
					<div class="col-md-12">
						@include('setting::include.input', [
							'type' => 'text',
							'name' => 'to',
							'placeholder' => now()->format('Y')
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
