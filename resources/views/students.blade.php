@extends('app')

@section('content')

    <div class="container">
        @foreach ($studentName as $a)
            <li><a href = "students/{{$a[0]}}">{{$a[1]}} {{$a[2]}} </a><br/></li>
        @endforeach
    </div>



@endsection