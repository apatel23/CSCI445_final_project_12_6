@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Team Contents:</div>

                    <div class="panel-body">



                        <div class="container">

                            {!! Form::open(array('url' => "updateTeam"))!!}
                            {!! Form::token() !!}


                            <div class="form-group">
                                <input style="visibility:hidden;width:400px" readonly type="text" class="form-control" name="id" id="id" value="{{$team->teamID}}"><br>
                                <input style="width:400px" type="text" class="form-control" name="team" id="team" value="{{$team->teamName}}">
                            </div>

                            @foreach ($teamContents as $a)
                                <label id = "{{$a->id}}" class="checkbox-inline"><input name = "{{$a->id}}" type="checkbox" checked>{{$a->name}} {{$a->lname}}</label><br/>
                            @endforeach
                            @foreach ($allStudents as $a)
                                <label id = "{{$a->id}}" class="checkbox-inline"><input name = "{{$a->id}}" type="checkbox">{{$a->name}} {{$a->lname}}</label><br/>
                            @endforeach
                            {!! Form::submit('Update',['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!} <br>


                        </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection