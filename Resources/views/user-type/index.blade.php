@extends('setting::layouts.master')

@section('setting::title', 'User Types')

@section('setting::breadcrumb-2')
	@include('setting::include.breadcrumb', [
		'title' => 'Setting',
		'active' => true,
		'url' => route('setting.index')
	])
@endsection

@section('setting::breadcrumb-3')
	@include('setting::include.breadcrumb', [
		'title' => 'User Type',
		'active' => false,
	])
@endsection

@section('setting::content')
<div class="row">
	<div class="col-12">

		@include('flash::message')

		<div class="card">
			<div class="card-header">
				<h4>User Types</h4>
				<div class="card-header-form">
					<a href="{{ route('setting.user-type.create') }}" class="btn btn-primary">
						<i class="fa fa-plus"></i> Add new
					</a>
				</div>
			</div>
			<div class="card-body p-4">
				<div class="table-responsive">
					{!! $dataTable->table(['class' => 'table table-bordered table-hover table-stripped']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('javascript')
@include('shared.wrapperDatatable')
@endpush
