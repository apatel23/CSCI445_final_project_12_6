@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$team->teamName}}
                    </div>
                    @foreach ($s as $a)
                        @if ($user == $a)

                            {!! Form::open(array('url' => 'updateTeamName')) !!}
                            {!! Form::token() !!}
                            <div class="form-group">
                                <input style="visibility:hidden; width:400px" readonly type="text" class="form-control" name="id" id="id" value="{{$team->teamID}}">
                            </div>
                            <div class="form-group">
                                <label for="name">New Name:</label>
                                <input style="width:400px" type="text" class="form-control" name="name" id="name" value="{{$team->teamName}}">
                            </div>
                            {!! Form::submit('Change Team Name',['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        @endif
                    @endforeach
                    <div class="panel-body">
                        <ul>
                        @foreach ($s as $t)
                            <li>{{$t->name}} {{$t->lname}}</li>
                        @endforeach
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection