@extends('layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<h1>@yield('setting::title', config('setting.name'))</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            @yield('setting::breadcrumb-2')
            @yield('setting::breadcrumb-3')
        </div>
	</div>

	<div class="section-body">
		@yield('setting::content')
	</div>
</section>
@endsection
