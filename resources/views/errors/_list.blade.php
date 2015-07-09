@if ($errors->any())
<div class="row errors">
<div class="col-lg-4 col-lg-offset-4 alert alert-danger">
	@foreach($errors->all() as $error)
		{{ $error }}<br/>
	@endforeach
</div>
</div>
@endif
