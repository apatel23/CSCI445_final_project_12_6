@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Info Page:</div>

                    <div class="panel-body">



                        <div class="container">
                            <form role="form">
                                <div class="form-group">
                                    <label for="name">First Name:</label>
                                    <input style="width:400px" readonly type="text" class="form-control" id="name" value="{{$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Last Name:</label>
                                    <input style="width:400px" readonly type="text" class="form-control" id="name" value="{{$user->lname}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input style="width:400px" readonly type="email" class="form-control" id="email" value="{{$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input style="width:400px" readonly type="tel" class="form-control" id="phone" value="{{$user->phoneNo}}">
                                </div>
                                <label for="classes">Relevant Classes Taken:</label>
                                <div class="form-group">
                                    @foreach($classes as $class)
                                        @if ($class->classID == 1)
                                            <p>CSCI 261</p>
                                        @elseif( $class->classID == 2)
                                            <p>CSCI 262</p>
                                        @elseif( $class->classID == 3)
                                            <p>CSCI 306</p>
                                        @elseif( $class->classID == 4)
                                            <p>CSCI 406</p>
                                        @endif

                                    @endforeach
                                </div>
                                <label for="languages">Language skill-level:</label>
                                <div class="form-group">
                                    <div class="scroll-bar">
                                        Python:
                                        <input style="width:800px" readonly type="range" class="scroll-bar" name="python_slide" min="1" max="10" value="{{ $pref[0]->python }}">
                                        Java:
                                        <input style="width:800px" readonly type="range" class="scroll-bar" name="java_slide" min="1" max="10" value="{{ $pref[0]->java }}">
                                        C/C++:
                                        <input style="width:800px" readonly type="range" class="scroll-bar" name="c_slide" min="1" max="10" value="{{ $pref[0]->c }}">
                                    </div>
                                </div>
                                <label for="style">Preferred team style:</label>
                                <div class="form-group">
                                    @if ($pref[0]->teamStyle == 1)
                                        <p>No preference</p>
                                    @elseif ($pref[0]->teamStyle == 2)
                                        <p>Prefers: Competitive Teams</p>
                                    @else
                                        <p>Prefers: Cooperative Teams</p>
                                    @endif

                                </div>

                            </form>
                        </div>









                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection