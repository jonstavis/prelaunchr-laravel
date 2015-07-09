{!! Form::open([ 'url' => route('user.store'), 'class' => 'form-inline join' ]) !!}
	@include('errors._summary')
	<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
		{!! Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'Your Email' ]) !!}
	</div>
	{!! Form::submit('Get Going', [ 'class' => 'btn btn-success' ]) !!}
{!! Form::close() !!}

