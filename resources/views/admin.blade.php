<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <h1>Welcome, Administrator!</h1>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Team Connect</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a>Welcome</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(auth()->guest())
                    @if(!Request::is('auth/login'))
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    @endif
                    @if(!Request::is('auth/register'))
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @endif
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

        <div class="form-group">
            <p><b>Current Teams: </b></p>
            <table class="table table-striped">
                @foreach($teamnames as $team)
                    <tr><td>{{ $team }}</td></tr>
                @endforeach
            </table>
        </div>
        {!!   Form::open(array('url' => 'generate')) !!}
        {!! Form::label('min', 'Minimum number of students per team: ') !!}
        {!! Form::text('min', null, ['class' => 'form-control']) !!}
        {!! Form::label('max', 'Maximum number of students per team: ') !!}
        {!! Form::text('max', null, ['class' => 'form-control']) !!} <br>
        {!! Form::label('comp','Select a competition: ') !!} <br>
        @for ($i = 0; $i < count($compName); $i++)
            {!! Form::radio('comp',$compID[$i]) !!}
            {!! Form::label('compName',$compName[$i]) !!}
            <br>
        @endfor

        {!! Form::submit('Generate teams',['class' => 'form-control']) !!}
        {!! Form::close() !!} <br>
        @if (! empty($notAdded))
            <p>These student ID's were not added to teams:</p>
            @foreach ($notAdded as $n)
            <p>{{ $n }}</p>
            @endforeach
        @endif
    </div>
</nav>

@yield('content')

        <!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>