@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>Edit Teams:</p>
                    </div>

                    <div class="panel-body">
                        <ul>
                            @foreach($teams as $t)
                                <li><a href = "editTeam/{{$t->teamID}}">{{$t->teamName}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class ="panel-heading">
                        <p>Quick Sort New Teams:</p>
                    </div>
                    <div class="panel-body">
                        <div class="container">

                            {!! Form::open(array('url' => 'generate')) !!}
                            {!! Form::token() !!}

                            <div class="form-group">
                                <label for="min">Minimum Students per Team:</label>
                                <input style="width:400px" type="text" class="form-control" name="min" id="min">
                            </div>
                            <div class="form-group">
                                <label for="max">Maximum Students per Team:</label>
                                <input style="width:400px" type="text" class="form-control" name="max" id="max">
                            </div>

                            @foreach($competitions as $c)
                                <input type="radio" name="competition" value = "{{$c->compID}}">{{$c->compName}}<br/>
                            @endforeach

                            {!! Form::submit('Sort Team',['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!} <br>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection