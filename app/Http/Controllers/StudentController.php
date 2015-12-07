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
    public function index()
    {
        //
        return view('auth\login');
    }

    public function divideTeam($team, $min, $max, $boolit, $compID)
    {
        $len = count($team);
        $numTeam = $len / $min;
        $totalTeam = array();
        //$team = array_flip($team);
        //return $team;
        if ($boolit)
        {
            $a = array_keys($team);
        }else{
            $a = $team;
        }
        //print_r($a);
        while(count($a) >= $min){
            $t = array();
            while(count($t) < $min){
                array_push($t, array_pop($a));
                $a = array_reverse($a);
            }
            array_push($totalTeam, $t);
        }

        if( count($a) > 0 && count($totalTeam) > 0 ) {
            $i = 0;
            foreach ($a as $b) {
                array_push($totalTeam[$i % count($totalTeam)], $b);
                $i = $i + 1;
            }
        }

        $unsorted = array();
        $teamteam = array();
        //return $totalTeam;

        foreach ($totalTeam as $c) {
            if( count($c) > $max) {
                while (count($c) > $max) {
                    print_r($c);
                    array_push($unsorted, array_pop($c));
                }
                array_push($teamteam, $c);
            }else {
                array_push($teamteam, $c);
            }
        }

        if (count($teamteam)  > 0 )
        {
            foreach($teamteam as $t) {
                team::create(['competition' => $compID,'teamName' => 'Unnamed Team']);
                $val = \DB::select(\DB::raw('(SELECT max(teamID) as i FROM team)'));
                $teamID= $val[0]->i;
                foreach($t as $s) {
                    //print_r($s);
                    //print_r(',');
                    team_contents::create(['teamID' => $teamID,'studentID' => $s]);
                    \DB::table('student_competition')->where('studentID' , '=', $s)->delete();
                }
            }
        }


        if (count($totalTeam == 0))
        {
            return $a;
        }

        return $unsorted;

    }


    public function generateTeam(Request $request){
        //DB::table('team_contents')->truncate();
        $min = $request->get('min');
        $max = $request->get('max');
        $compId = $request->get('comp');
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
        $unsorted = array();
        //return $this->divideTeam($std_j, $min, $max);
        //return count($std_p) + count($std_c) + count($std_p) + count($std_u);
        // return $unsorted + $this->divideTeam($std_u, $min, $max, true, $compId);
        //$unsorted = $unsorted + $this->divideTeam($std_j, $min, $max, true, $compId);
        //print_r($unsorted);
        //$unsorted = $unsorted + $this->divideTeam($std_c, $min, $max, true, $compId);
        //print_r($unsorted);
        //$unsorted = $unsorted + $this->divideTeam($std_p, $min, $max, true, $compId);
        //print_r($unsorted);
        //$unsorted = $unsorted + $this->divideTeam($std_u, $min, $max, true, $compId);
        $ss = array();
        $ss = $std_c + $std_j + $std_p + $std_u;

        $ss = array_keys($ss);
        shuffle($ss);
        $totteam = array();
        while(count($ss) > 0){
            $a = array();
            while(count($a) < $min ){
                array_push($a, array_pop($ss));
            }
            array_push($totteam, $a);
        }

        //print_r($totteam);
        $notAdded = array();
        $added = array();
        foreach($totteam as $t){
            $test = false;
            foreach($t as $g){
                if($g == null){
                    $test = true;
                    break;
                }
            }

            if ($test){
                array_push($notAdded, $t);
            }else{
                array_push($added, $t);
            }
        }

        $i = 0;
        if( $min != $max ) {
            if (count($notAdded) > 0) {
                foreach ($notAdded[0] as $nA) {
                    if ($nA != null) {
                        while ($i < count($added[$i])) {
                            if (count($added[$i]) < $max) {
                                array_shift($notAdded[0]);
                                array_push($added[$i], $nA);
                                //array_push($finalAdd, $a);
                                $i++;
                                break;
                            }
                            $i++;
                            break;
                        }
                    } else {
                        array_shift($notAdded[0]);
                    }
                }
            }
        }
        $notAdded = $notAdded[0];
        $stdc = count($notAdded);
        //return $notAdded;

        foreach($added as $t) {
            team::create(['competition' => $compId,'teamName' => 'Unnamed Team']);
            $val = \DB::select(\DB::raw('(SELECT max(teamID) as i FROM team)'));
            $teamID= $val[0]->i;
            foreach($t as $s) {
                //print_r($s);
                //print_r(',');
                team_contents::create(['teamID' => $teamID,'studentID' => $s]);
                \DB::table('student_competition')->where('studentID' , '=', $s)->delete();
            }
        }
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

        return view('admin',compact('teamnames', 'compID', 'compName','notAdded'));

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
        //return $admin_id;
        //$admin_id = $admin_id[0]->id;

        if(count($admin_id)) {
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
            return view('admin',compact('teamnames', 'compID', 'compName'));
        } else {
            //return $pref[0]->python;
            // return $user->id;
            $teamcontent = team_contents::where('studentID','=' , $user->id)->get(array('teamID'));
            $teamname = array();
            foreach( $teamcontent as $teamId){
                $name = team::where('teamID', '=', $teamId->teamID)->get(array('teamName'));
                array_push($teamname, $name[0]->teamName);
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
        return "Sucks to suck";
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