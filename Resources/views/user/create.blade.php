@extends('setting::layouts.master')

@section('setting::title', 'Add New User')

@section('setting::breadcrumb-2')
	@include('setting::include.breadcrumb', [
		'title' => 'Users',
		'active' => true,
		'url' => route('setting.users.index')
	])
@endsection

@section('setting::breadcrumb-3')
	@include('setting::include.breadcrumb', [
		'title' => 'New User',
		'active' => false,
	])
@endsection

@section('setting::content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>Form</h4>
				<div class="card-header-form">
					<a href="{{ route('setting.users.index') }}" class="btn btn-warning">
						<i class="fa fa-arrow-left"></i> Back
					</a>
				</div>
			</div>
			{!! Form::open([
				'route' => 'setting.users.store',
				'onsubmit' => "submitButton.disabled = true"
			]) !!}
				@include('setting::user.form')
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
