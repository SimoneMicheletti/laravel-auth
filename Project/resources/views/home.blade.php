@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

			<br>

			<div class="card">
                <div class="card-header">Upload you image</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('updateUserIcon')}}" method="post" enctype="multipart/form-data">

						@csrf
						@method('POST')

						<input type="file" name="icon">
						<br>
						<input type="submit" value="SAVE YOUR ICON" class="btn btn-primary">
						<a href="{{ route('clearUserIcon') }}" class="btn btn-danger">CANCEL YOUR ICON</a>

					</form>
                </div>
            </div>

			@if (Auth::user() -> icon)
			
				<br>
	
				<div class="card">
					<div class="card-header">Your Image</div>
	
					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
	
						<img src="{{ asset('storage/icon/' . Auth::User() -> icon) }}" width="100%">
	
					</div>
				</div>
			@endif
        </div>
    </div>
</div>
@endsection
