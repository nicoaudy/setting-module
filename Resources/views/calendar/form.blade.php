<div class="card-body p-4">
	<div class="row">
		<div class="col-md-12">
			@include('setting::include.input', [
				'type' => 'text',
				'name' => 'name',
				'placeholder' => 'Enter name..'
			])
		</div>
		<div class="col-md-12">
			@include('setting::include.textarea', [
				'name' => 'description',
				'placeholder' => 'Enter description..'
			])
		</div>
	</div>
</div>
@include('setting::include.button')
