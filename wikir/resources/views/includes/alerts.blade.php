@if ($errors->any())
	<div class="alert alert-warning">
		@foreach($errors->all() as $error)
			<p>{{$error}}</p>
		@endforeach
	</div>
@endif

@if (session('success'))
	<div class="alert alert-success">
		<b>{{ session('success')}}</b>
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger">
		<b>{{ session('error')}}</b>
	</div>
@endif

@if(isset($message))
<div class="alert alert-warning">
    <b>{{ $message }}</b>
</div>
@endif