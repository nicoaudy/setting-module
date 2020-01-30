@extends('setting::layouts.master')

@section('setting::title', 'Setting')

@section('setting::breadcrumb-2')
	@include('setting::include.breadcrumb', [
		'title' => 'Setting',
		'active' => true,
		'url' => route('setting.index')
	])
@endsection

@section('setting::content')
	<div class="section-body">
		<h2 class="section-title">Overview</h2>
		<p class="section-lead">
			Organize and adjust all settings
		</p>

		<div class="row">
			@can('view calendar')
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fas fa-calendar-alt"></i>
					</div>
					<div class="card-body">
						<h4>Calendar</h4>
						<p>Calendar settings for user</p>
							<a href="{{ route('setting.calendar.index') }}" class="card-cta">See in details <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			@endcan
			@can('view user')
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fas fa-user"></i>
					</div>
					<div class="card-body">
						<h4>User</h4>
						<p>Database all users.</p>
							<a href="{{ route('setting.users.index') }}" class="card-cta">See in details <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			@endcan
			@can('view user type')
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fas fa-user-cog"></i>
					</div>
					<div class="card-body">
						<h4>User Type</h4>
						<p>Setting up user type.</p>
							<a href="{{ route('setting.user-type.index') }}" class="card-cta">See in details <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			@endcan
			@can('view workflow')
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fas fa-database"></i>
					</div>
					<div class="card-body">
						<h4>Workflow</h4>
						<p>Setting up workflow.</p>
							<a href="{{ route('setting.workflow.index') }}" class="card-cta">See in details <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			@endcan
		</div>
	</div>
@endsection
