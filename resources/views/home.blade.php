@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Your Home Page:
				</div>

				<div class="panel-body">

					@if (count($teamname))
						<p>{{ $user->name }} {{$user->lname }}, you are part of the following teams: </p>
					<ul>
					@foreach( $teamname as $tname)
						<li>

							<p><a href = "team/{{$tname[0]}}">{{$tname[1]}}</a></p>
						</li>
					@endforeach
					</ul>
					@else
							<p>Please Sign Up for competitions</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection