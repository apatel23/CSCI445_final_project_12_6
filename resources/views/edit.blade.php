@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Info Page:</div>

                    <div class="panel-body">



                        <div class="container">

                            {!! Form::open(array('url' => 'update')) !!}
                            {!! Form::token() !!}
    

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input style="width:400px" type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input style="width:400px" type="tel" class="form-control" name="phone" id="phone" value="{{$user->phoneNo}}">
                            </div>

                            {!! Form::label('classes', 'Relevant Classes Taken: ') !!} <br>


                            <?php
                            $a = '';
                            $b = '';
                            $c = '';
                            $d = '';
                            foreach ($classes as $class){
                                if( $class->classID == 1) $a = 'checked';
                                if( $class->classID == 2) $b = 'checked';
                                if( $class->classID == 3) $c = 'checked';
                                if( $class->classID == 4) $d = 'checked';
                            }
                            echo '<label id = "261" class="checkbox-inline"><input name = "261" type="checkbox"'."{$a}".'>CSCI 261</label><br/>';
                            echo '<label id = "262" class="checkbox-inline"><input name = "262" type="checkbox"' ."{$b}".' >CSCI 262</label><br/>';
                            echo '<label id = "306" class="checkbox-inline"><input name = "306" type="checkbox"'." {$c}".' >CSCI 306</label><br/>';
                            echo '<label id = "406" class="checkbox-inline"><input name = "406" type="checkbox"'." {$d}".' >CSCI 406</label><br/>';

                            ?>

                            <label for="languages">Language skill-level:</label>
                            <div class="form-group">
                                <div class="scroll-bar">
                                    Python:
                                    <input style="width:400px" type="range" class="scroll-bar" name="python_slide" min="1" max="10" value="{{ $pref[0]->python }}">
                                    Java:
                                    <input style="width:400px" type="range" class="scroll-bar" name="java_slide" min="1" max="10" value="{{ $pref[0]->java }}">
                                    C/C++:
                                    <input style="width:400px" type="range" class="scroll-bar" name="c_slide" min="1" max="10" value="{{ $pref[0]->c }}">
                                </div>
                            </div>
                            <label for="style">Preferred team style:</label>
                            <div class="form-group">
                                <?php
                                $val = $pref[0]->teamStyle;
                                $arr = array(1,3,'');
                                $arr[$val-1] = 'checked';
                                echo '<input type="radio" name="team-style" value = "1" '.$arr[0].'>No Preference<br/>';
                                echo '<input type="radio" name="team-style" value = "2" '.$arr[1].'>Competitive<br/>';
                                echo '<input type="radio" name="team-style" value = "3" '.$arr[2].'>Cooperative<br/>';

                                ?>

                            </div>

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