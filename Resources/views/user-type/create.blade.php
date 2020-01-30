@extends('setting::layouts.master')

@section('setting::title', 'Add New')

@section('setting::breadcrumb-2')
	@include('setting::include.breadcrumb', [
		'title' => 'User Types',
		'active' => true,
		'url' => route('setting.user-type.index')
	])
@endsection

@section('setting::breadcrumb-3')
	@include('setting::include.breadcrumb', [
		'title' => 'New User Type',
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
					<a href="{{ route('setting.user-type.index') }}" class="btn btn-warning">
						<i class="fa fa-arrow-left"></i> Back
					</a>
				</div>
			</div>
			{!! Form::open([
				'route' => 'setting.user-type.store',
				'onsubmit' => "submitButton.disabled = true"
			]) !!}
				@include('setting::user-type.form')
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
