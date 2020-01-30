<div class="breadcrumb-item {{ $active ?? 'active' }}">
	<a href="{{ $active ? $url : '#' }}">{{ $title ?? config('setting.name') }}</a>
</div>
