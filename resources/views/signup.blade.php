@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Sign up for Competitions:</div>

                    <div class="panel-body">



                        <div class="container">

                            {!! Form::open(array('url' => 'signup_update')) !!}
                            {!! Form::token() !!}


                            @foreach ($competition as $c)
                                <label id = "{{$c->compID}}" class="checkbox-inline"><input name = "{{$c->compID}}" type="checkbox">{{$c->compName}}</label><br/>
                            @endforeach



                            {!! Form::submit('Sign Up',['class' => 'btn btn-primary']) !!}
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