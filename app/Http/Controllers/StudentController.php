<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\team;
use App\admin;
use App\team_contents;
use App\student_classes;
use App\student_preferences;
use App\student_competition;
use App\competition;

class StudentController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(){
        $user = \Auth::user();
        $user_id = $user->id;
        $admin_id = admin::where('id','=',$user_id)->get();
        if(count($admin_id)){
            $bool = true;
        } else {
            $bool = false;
        }
        return $bool;
    }

    public function newCompetition(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $name = $request->get('name');
        competition::create(['compName'=>$name]);
        return redirect('home');
    }

    public function index()
    {
        //
        return view('auth\login');
    }

    public function signup() {
        $user = \Auth::user();
        $team = team_contents::where('studentID','=',$user->id)->get(array('teamID'));
        $c = array();
        foreach($team as $t) {
            $a = team::where('teamID','=',$t->teamID)->first(array('competition'));
            array_push($c,$a->competition);
        }
        $cc = student_competition::where('studentID','=',$user->id)->get(array('compID'));
        foreach($cc as $b) {
            array_push($c,$b->compID);
        }
        $competition = competition::whereNotIn('compID',$c)->get();
        return view('signup',compact('user','competition'));
    }

    public function updateTeamName(Request $request) {
        $newName = $request->get('name');
        $t = team::where('teamID','=',($request->get('id')))->update(['teamName'=>$newName]);

        return redirect('home');
    }

    public function viewStudents(){

        if ( !$this->auth()) return "You have no Permissions!";
        $students = User::all();
        $id = array();
        $studentName = array();
        $last = array();
        foreach($students as $a) {
            $name = array();
            array_push($name, $a->id);
            array_push($name, $a->name );
            array_push($name, $a->lname);
            array_push($last, $a->lname);
            array_push($studentName, $name);
        }
        array_multisort($last,SORT_ASC, $studentName);
        //return $studentName;
        return view('students', compact('studentName', 'id'));
    }

    public function viewStudent($id){
        if ( !$this->auth()) return "You have no Permissions!";
        $user = user::where('id', '=', $id)->get();
        $user = $user[0];
        $pref = student_preferences::where('id','=',$id)->get();
        $classes = student_classes::where('id','=',$id)->get(array('classID'));

        return view('studentInfo', compact('user', 'pref', 'classes'));

    }


    public function team($id) {
        $user = \Auth::user();
        $team = team::where('teamID','=',$id)->first();

        $teamcontents = team_contents::where('teamID','=',$id)->get();
        $s = array();
        foreach ($teamcontents as $t) {
            $a = User::where('id', '=', $t->studentID)->first();
            array_push($s, $a);
        }
        return view('team',compact('user','team','s'));
    }

    public function arraysplit($arr){
        $len = count($arr);
        $first = array();
        $second = array();
        for( $i = 0; $i < $len ; $i++){
            if( $i < $len/2 ){
                array_push($first, $arr[$i]);
            }else{
                array_push($second, $arr[$i]);
            }
        }
        $odd = array();
        while( count($first) != count($second)) {
            if (count($first) > count($second)) {
                array_push($odd, array_pop($first));
            } elseif (count($first) < count($second)) {
                array_push($odd, array_pop($second));
            }
        }
        arsort($second);
        $final = array();
        while( count($first) > 0 && count($second) > 0){
            array_push($final, array_pop($first));
            array_push($final, array_pop($second));
        }
        while( count($odd) > 0) {
            array_push($final, array_pop($odd));
        }
        return $final;

    }
    public function divideTeamone($ss, $min, $max, $compId){
        if ($ss == null || count($ss) == 0) {return array();}


        $tt = array_chunk($ss,$min);
        $end = null;
        if (count(end($tt))<$min) {
            $end = array_pop($tt);
        }
        if ($end != null) {
            for ($i =0; $i < count($tt);$i++) {
                while (count($tt[$i]) < $max) {
                    if (count($end) == 0) {
                        break;
                    }
                    array_push($tt[$i], array_pop($end));
                }
            }
        }



        foreach($tt as $t) {
            team::create(['competition' => $compId,'teamName' => 'Unnamed Team']);
            $val = \DB::select(\DB::raw('(SELECT max(teamID) as i FROM team)'));
            $teamID= $val[0]->i;
            foreach($t as $s) {
                team_contents::create(['teamID' => $teamID,'studentID' => $s]);
                \DB::table('student_competition')->where('studentID' , '=', $s)->where('compID','=',$compId)->delete();
            }
        }

        if( $end == null) {
            $end = array();
        }
        return $end;
    }

    public function generateTeam(Request $request){
        if ( !$this->auth()) return "You have no Permissions!";
        //DB::table('team_contents')->truncate();
        $this->validate($request, [
            'min' => 'required|integer',
            'max' => 'required|integer|greater_than_field:min',
            'competition' => 'required',
        ]);
        $min = $request->get('min');
        $max = $request->get('max');
        $compId = $request->get('competition');
        $students_p = \DB::table('student_competition')
            ->join('student_preferences', 'student_competition.studentID' , '=' , 'student_preferences.id')
            ->select('student_competition.studentID', 'student_preferences.python', 'student_preferences.java', 'student_preferences.c', 'student_preferences.teamStyle')
            ->where('student_competition.compID', '=',$compId )
            ->get();

        $students_c = student_classes::all();
        $std_j = array();
        $std_p = array();
        $std_c = array();
        $std_u = array();

        foreach ( $students_p as $a) {
            if( $a->java > $a->python and $a->java > $a->c) {
                $std_j[$a->studentID] = $a->java;
            }
            elseif ( $a->python > $a->c and $a->python > $a-> c) {
                $std_p[$a->studentID] = $a->python;
            }
            elseif ( $a->c > $a->python and $a->c > $a->java) {
                $std_c[$a->studentID] = $a->c;
            }else {
                $std_u[$a->studentID] = $a->c;
            }
        }
        foreach( $students_c as $c){
            if (array_key_exists($c->studentID, $std_j)) {
                $std_j[$c->studentID] = $std_j[$c->studentID] + $c->classID;
            }
            if (array_key_exists($c->studentID, $std_p)) {
                $std_p[$c->studentID] = $std_p[$c->studentID] + $c->classID;
            }
            if (array_key_exists($c->studentID, $std_c)) {
                $std_c[$c->studentID] = $std_c[$c->studentID] + $c->classID;
            }
            if (array_key_exists($c->studentID, $std_u)) {
                $std_u[$c->studentID] = $std_u[$c->studentID] + $c->classID;
            }
        }

        asort($std_j);
        asort($std_c);
        asort($std_p);
        asort($std_u);
        $std_j = array_keys($std_j);
        $std_c = array_keys($std_c);
        $std_p = array_keys($std_p);
        $std_u = array_keys($std_u);

        $unsorted = array();

        $std_j = $this->arraysplit($std_j);
        $std_c = $this->arraysplit($std_c);
        $std_p = $this->arraysplit($std_p);
        $std_u = $this->arraysplit($std_u);


        $std_j = $this->divideTeamone($std_j, $min, $max, $compId);
        $std_c = $this->divideTeamone($std_c, $min, $max, $compId);
        $std_p = $this->divideTeamone($std_p, $min, $max, $compId);
        $std_u = $this->divideTeamone($std_u, $min, $max, $compId);

        $noTeam = array_merge($std_j, $std_c, $std_p, $std_u);
        $noTeam = $this->divideTeamone($noTeam, $min, $max, $compId);


        $teams = team::all();
        $competitions = competition::all();
        $compID = array();
        $compName = array();
        $teamnames = array();
        foreach( $competitions as $c) {
            array_push($compID, $c->compID);
            array_push($compName, $c->compName);
        }
        foreach( $teams as $t) {
            array_push($teamnames, $t->teamName);
        }

        return view('admin',compact('teams', 'competitions'));

    }

    public function editTeam($id) {
        if ( !$this->auth()) return "You have no Permissions!";
        $team = team::where('teamID','=',$id)->first();
        $students = team_contents::where('teamID','=',$id)->get(array('studentID'));
        $s = array();
        foreach($students as $a) {
            array_push($s,$a->studentID);
        }
        $teamContents = User::whereIn('id',$s)->get();
        $allStudents = User::whereNotIn('id',$s)->get();
        return view('editTeam',compact('team','teamContents','allStudents'));
    }

    public function updateTeam(Request $request) {
        $students = User::all();
        \DB::table('team')
            ->where('teamID', $request->get('id'))
            ->update(['teamName'=> $request->get('team')]);
        $t = team::where('teamName','=',$request->get('team'))->first();
        team_contents::where('teamID','=',$t->teamID)->delete();
        foreach ($students as $s){
            $numberwang = $request->get($s->id);
            if ($numberwang == "on") {
                team_contents::create(['teamID'=>$t->teamID,'studentID'=>$s->id]);
            }
        }
        return redirect('home');
    }






    public function studentInfo() {
        $user = \Auth::user();
        $pref = student_preferences::where('id','=',$user->id)->get();
        $classes = student_classes::where('id','=',$user->id)->get(array('classID'));

        return view('studentInfo', compact('user', 'pref', 'classes'));

    }

    public function editInfoPage() {
        $user = \Auth::user();
        $pref = student_preferences::where('id','=',$user->id)->get();
        $classes = student_classes::where('id','=',$user->id)->get(array('classID'));
        return view('edit', compact('user', 'pref', 'classes'));
    }

    public function UpdateSignup(Request $request) {

        $user = \Auth::user();
        $id = $user->id;

        $team = team_contents::where('studentID','=',$user->id)->get(array('teamID'));
        $c = array();
        foreach($team as $t) {
            $a = team::where('teamID','=',$t->teamID)->first(array('competition'));
            array_push($c,$a->competition);
        }
        $cc = student_competition::where('studentID','=',$user->id)->get(array('compID'));
        foreach($cc as $b) {
            array_push($c,$b->compID);
        }
        $competition = competition::whereNotIn('compID',$c)->get();
        foreach($competition as $a) {
            $numberwang = $request->get($a->compID);
            if ($numberwang == "on") {
                student_competition::create(['studentID'=>$id,'compID'=>$a->compID]);
            }
        }
        return redirect('home');
    }


    public function UpdateInfoPage(Request $request) {
        $user = \Auth::user();
        $id = $user->id;

        $email = $request->get('email');
        $phone = $request->get('phone');

        $c261 = $request->get('261');
        $c262 = $request->get('262');
        $c306 = $request->get('306');
        $c406 = $request->get('406');

        $python = $request->get('python_slide');
        $java = $request->get('java_slide');
        $c = $request->get('c_slide');

        $pref = $request->get('team-style');


        $std = User::find($id);
        $std->email = $email;
        $std->phoneNo = $phone;
        $std->save();

        $preferences = student_preferences::find($id);
        $preferences->python = $python;
        $preferences->java = $java;
        $preferences->c = $c;
        $preferences->teamStyle = $pref;
        $preferences->save();

        $classes = \DB::select(\DB::raw('(SELECT * FROM student_classes WHERE id = ' . $id. ')'));
        if( count($classes) > 0) {
            foreach ($classes as $c) {
                $class = student_classes::find($c->id);
                if( $class != null) {
                    $class->delete();
                }
            }
        }

        if( $c261 == 'on'){
            student_classes::create(['id'=>$id,'classID'=>1]);
        }
        if( $c262 == 'on'){
            student_classes::create(['id'=>$id,'classID'=>2]);
        }
        if( $c306 == 'on'){
            student_classes::create(['id'=>$id,'classID'=>3]);
        }
        if( $c406 == 'on'){
            student_classes::create(['id'=>$id,'classID'=>4]);
        }


        return redirect('home');
    }



    public function homepage() {
        $user = \Auth::user();
        $user_id = $user->id;
        $admin_id = admin::where('id','=',$user_id)->get();

        if(count($admin_id)) {
            $teams = team::all();
            $competitions = competition::all();
            return view('admin',compact('teams', 'competitions'));
        } else {
            $teamcontent = team_contents::where('studentID','=' , $user->id)->get(array('teamID'));
            $teamname = array();
            foreach( $teamcontent as $teamId){
                $name = team::where('teamID', '=', $teamId->teamID)->get(array('teamName'));
                $t = array();
                array_push($t,$teamId->teamID);
                array_push($t, $name[0]->teamName);
                array_push($teamname, $t);
            }
            return view('home',compact('teamname', 'user'));
        }

    }

    public function admin() {
        $teams = team::all()->get();
        $teamnames = array();
        foreach( $teams as $t) {
            array_push($teamnames, $teams[0]->teamName);
        }
        return view('admin',compact('teamnames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(/*Request $request, $id*/)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}