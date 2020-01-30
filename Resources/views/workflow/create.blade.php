@extends('setting::layouts.master')

@section('setting::title', 'Add New Workflow')

@section('setting::breadcrumb-2')
	@include('setting::include.breadcrumb', [
		'title' => 'Workflow',
		'active' => true,
		'url' => route('setting.workflow.index')
	])
@endsection

@section('setting::breadcrumb-3')
	@include('setting::include.breadcrumb', [
		'title' => 'New Workflow',
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
					<a href="{{ route('setting.workflow.index') }}" class="btn btn-warning">
						<i class="fa fa-arrow-left"></i> Back
					</a>
				</div>
			</div>
			{!! Form::open([
				'route' => 'setting.workflow.store',
				'onsubmit' => "submitButton.disabled = true"
			]) !!}
				@include('setting::workflow.form')
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

@push('javascript')
	<script>
		$("input[name='type']").click(function() {
			if ($("#employee").is(":checked")) {
				$("#1").show();
				$("#2").hide();
			}
			if ($("#role").is(":checked")) {
				$("#1").hide();
				$("#2").show();
			}
		});
	</script>
@endpush
