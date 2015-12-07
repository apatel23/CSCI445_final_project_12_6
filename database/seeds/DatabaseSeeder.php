<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\admin;
use App\classes;
use App\competition;
use App\student_classes;
use App\student_preferences;
use App\team;
use App\team_contents;
use App\User;
use App\student_competition;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(userTableSeeder::class);
        $this->call(adminTableSeeder::class);
        $this->call(classesTableSeeder::class);
        $this->call(competitionTableSeeder::class);
        $this->call(student_classesTableSeeder::class);
        $this->call(student_preferencesTableSeeder::class);
        $this->call(teamTableSeeder::class);
        $this->call(team_contentsTableSeeder::class);
        $this->call(student_competitionTableSeeder::class);

        Model::reguard();
    }
}
class userTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create(['name' => 'Mickey','lname' => 'Mouse','cwid' => '123978','email' => 'mmouse@mines.edu','password' => bcrypt('mmouse'),'phoneNo' => '9704301245']);
        User::create(['name' => 'Donald','lname' => 'Duck','cwid' => '444321','email' => 'dduck@mines.edu','password' => bcrypt('dduck1'),'phoneNo' => '9709809563']);
        User::create(['name' => 'Jane','lname' => 'Jetson','cwid' => '999777','email' => 'jjetson@mines.edu','password' => bcrypt('jjetson'),'phoneNo' => '9709889740']);
        User::create(['name' => 'Frodo','lname' => 'Baggins','cwid' => '555123','email' => 'fbaggins@mines.edu','password' => bcrypt('fbaggins')]);
        User::create(['name' => 'Bilbo','lname' => 'Baggins','cwid' => '988777','email' => 'bbaggins@mines.edu','password' => bcrypt('bbaggins')]);
        User::create(['name' => 'Winnie','lname' => 'Poohbear','cwid' => '478234','email' => 'pbear@mines.edu','password' => bcrypt('wpoohbear')]);
        User::create(['name' => 'Daffy','lname' => 'Duck','cwid' => '120978','email' => 'daduck@mines.edu','password' => bcrypt('dduck1')]);
        User::create(['name' => 'Wile','lname' => 'Coyote','cwid' => '409123','email' => 'wcoyote@mines.edu','password' => bcrypt('wcoyote')]);
        User::create(['name' => 'Road','lname' => 'Runner','cwid' => '128745','email' => 'rrunner@mines.edu','password' => bcrypt('rrunner')]);
        User::create(['name' => 'Marge','lname' => 'Simpson','cwid' => '765120','email' => 'msimpson@mines.edu','password' => bcrypt('msimpson')]);
        User::create(['name' => 'Charlie','lname' => 'Brown','cwid' => '876123','email' => 'cbrown@mines.edu','password' => bcrypt('cbrown')]);
        User::create(['name' => 'Lucy','lname' => 'VanPelt','cwid' => '333221','email' => 'lvanpelt@mines.edu','password' => bcrypt('lvanpelt')]);
        User::create(['name' => 'Bugs','lname' => 'Bunny','cwid' => '752412','email' => 'bbunny@mines.edu','password' => bcrypt('bbunny')]);
        User::create(['name' => 'Betty','lname' => 'Boop','cwid' => '532109','email' => 'bboop@mines.edu','password' => bcrypt('bboop1')]);
        User::create(['name' => 'Lois','lname' => 'Griffin','cwid' => '223311','email' => 'lgriffin@mines.edu','password' => bcrypt('lgriffin')]);
        User::create(['name' => 'Wilma','lname' => 'Flintstone','cwid' => '443322','email' => 'wflintstone@mines.edu','password' => bcrypt('wflintstone')]);
        User::create(['name' => 'Fred','lname' => 'Flintstone','cwid' => '443311','email' => 'fflintstone@mines.edu','password' => bcrypt('fflintstone')]);
        User::create(['name' => 'Peppa','lname' => 'Pig','cwid' => '784512','email' => 'ppig@mines.edu','password' => bcrypt('ppig11')]);
        User::create(['name' => 'Turanga','lname' => 'Leela','cwid' => '834215','email' => 'leela@mines.edu','password' => bcrypt('tleela')]);
        User::create(['name' => 'Sylvester','lname' => 'Cat','cwid' => '920451','email' => 'scat@mines.edu','password' => bcrypt('scat11')]);
        User::create(['name' => 'Felix','lname' => 'Cat','cwid' => '375621','email' => 'fcat@mines.edu','password' => bcrypt('fcat11')]);
        User::create(['name' => 'Top','lname' => 'Cat','cwid' => '781234','email' => 'tc@mines.edu','password' => bcrypt('tcat11')]);
        User::create(['name' => 'Scooby','lname' => 'Doo','cwid' => '392875','email' => 'scooby@mines.edu','password' => bcrypt('sdoo11')]);
        User::create(['name' => 'Porky','lname' => 'Pig','cwid' => '123654','email' => 'porky@mines.edu','password' => bcrypt('ppig11')]);
        User::create(['name' => 'Garfield','lname' => 'Cat','cwid' => '387612','email' => 'garfield@mines.edu','password' => bcrypt('gcat11')]);
        User::create(['name' => 'Peter','lname' => 'Pan','cwid' => '982765','email' => 'pan@mines.edu','password' => bcrypt('ppan11')]);
        User::create(['name' => 'Foghorn','lname' => 'Leghorn','cwid' => '762341','email' => 'fleghorn@mines.edu','password' => bcrypt('fleghorn')]);
        User::create(['name' => 'Manning','lname' => 'Peyton','cwid' => '772233','email' => 'pmanning@mines.edu','password' => bcrypt('mpeyton')]);
        User::create(['name' => 'Green','lname' => 'Virgil','cwid' => '123456','email' => 'vgreen@mines.edu','password' => bcrypt('gvirgil')]);
        User::create(['name' => 'Thomas','lname' => 'Julias','cwid' => '123457','email' => 'jthomas@mines.edu','password' => bcrypt('tjulias')]);
        User::create(['name' => 'Sanders','lname' => 'Emmanuel','cwid' => '123458','email' => 'esanders@mines.edu','password' => bcrypt('semmanuel')]);
        User::create(['name' => 'Tamme','lname' => 'Jason','cwid' => '123569','email' => 'jtamme@mines.edu','password' => bcrypt('tjason')]);
        User::create(['name' => 'Knighton','lname' => 'Terrance','cwid' => '123450','email' => 'tk@mines.edu','password' => bcrypt('kterrance')]);
        User::create(['name' => 'Colquitt','lname' => 'Britton','cwid' => '98765','email' => 'bcol@mines.edu','password' => bcrypt('cbritton')]);
        User::create(['name' => 'Roby','lname' => 'Bradley','cwid' => '98764','email' => 'broby@mines.edu','password' => bcrypt('rbradley')]);
        User::create(['name' => 'Ward','lname' => 'T.J.','cwid' => '98763','email' => 'tjward@mines.edu','password' => bcrypt('wtj111')]);
        User::create(['name' => 'Ware','lname' => 'DeMarcus','cwid' => '98762','email' => 'dware@mines.edu','password' => bcrypt('wdemarcus')]);
        User::create(['name' => 'Webster','lname' => 'Kayvon','cwid' => '98761','email' => 'kw@mines.edu','password' => bcrypt('wkayvon')]);

    }

}

class adminTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin')->delete();

        admin::create(['id' => '1']);
    }
}

class classesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classes')->delete();

        classes::create(['course_no' => 'CSCI261']);
        classes::create(['course_no' => 'CSCI262']);
        classes::create(['course_no' => 'CSCI306']);
        classes::create(['course_no' => 'CSCI406']);

    }
}

class competitionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('competition')->delete();

        competition::create(['compName' => 'Coding is fun!']);
        competition::create(['compName' => 'Coding isn\'t fun!']);
        competition::create(['compName' => 'Coding is meh...']);


    }
}

class student_classesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('student_classes')->delete();

        student_classes::create(['id' => '1','classID' => '1']);
        student_classes::create(['id' => '1','classID' => '2']);
        student_classes::create(['id' => '1','classID' => '3']);
        student_classes::create(['id' => '1','classID' => '4']);
        student_classes::create(['id' => '2','classID' => '1']);
        student_classes::create(['id' => '2','classID' => '2']);
        student_classes::create(['id' => '2','classID' => '3']);
        student_classes::create(['id' => '3','classID' => '1']);
        student_classes::create(['id' => '3','classID' => '2']);
        student_classes::create(['id' => '4','classID' => '1']);
        student_classes::create(['id' => '5','classID' => '1']);
        student_classes::create(['id' => '5','classID' => '2']);
        student_classes::create(['id' => '6','classID' => '1']);
        student_classes::create(['id' => '6','classID' => '2']);
        student_classes::create(['id' => '6','classID' => '3']);
        student_classes::create(['id' => '7','classID' => '1']);
        student_classes::create(['id' => '7','classID' => '2']);
        student_classes::create(['id' => '7','classID' => '3']);
        student_classes::create(['id' => '7','classID' => '4']);
        student_classes::create(['id' => '8','classID' => '2']);
        student_classes::create(['id' => '8','classID' => '3']);
        student_classes::create(['id' => '8','classID' => '4']);
        student_classes::create(['id' => '9','classID' => '2']);
        student_classes::create(['id' => '9','classID' => '3']);
        student_classes::create(['id' => '10','classID' => '2']);
        student_classes::create(['id' => '11','classID' => '2']);
        student_classes::create(['id' => '11','classID' => '3']);
        student_classes::create(['id' => '12','classID' => '2']);
        student_classes::create(['id' => '12','classID' => '3']);
        student_classes::create(['id' => '12','classID' => '4']);
        student_classes::create(['id' => '13','classID' => '3']);
        student_classes::create(['id' => '13','classID' => '4']);
        student_classes::create(['id' => '14','classID' => '3']);
        student_classes::create(['id' => '15','classID' => '3']);
        student_classes::create(['id' => '15','classID' => '4']);
        student_classes::create(['id' => '16','classID' => '4']);
        student_classes::create(['id' => '17','classID' => '3']);
        student_classes::create(['id' => '17','classID' => '4']);
        student_classes::create(['id' => '18','classID' => '2']);
        student_classes::create(['id' => '18','classID' => '3']);
        student_classes::create(['id' => '18','classID' => '4']);
        student_classes::create(['id' => '19','classID' => '1']);
        student_classes::create(['id' => '19','classID' => '2']);
        student_classes::create(['id' => '19','classID' => '3']);
        student_classes::create(['id' => '19','classID' => '4']);
        student_classes::create(['id' => '20','classID' => '1']);
        student_classes::create(['id' => '20','classID' => '2']);
        student_classes::create(['id' => '20','classID' => '3']);
        student_classes::create(['id' => '20','classID' => '4']);
        student_classes::create(['id' => '21','classID' => '1']);
        student_classes::create(['id' => '21','classID' => '2']);
        student_classes::create(['id' => '21','classID' => '3']);
        student_classes::create(['id' => '22','classID' => '1']);
        student_classes::create(['id' => '22','classID' => '2']);
        student_classes::create(['id' => '23','classID' => '1']);
        student_classes::create(['id' => '24','classID' => '1']);
        student_classes::create(['id' => '24','classID' => '2']);
        student_classes::create(['id' => '25','classID' => '1']);
        student_classes::create(['id' => '25','classID' => '2']);
        student_classes::create(['id' => '25','classID' => '3']);
        student_classes::create(['id' => '26','classID' => '1']);
        student_classes::create(['id' => '26','classID' => '2']);
        student_classes::create(['id' => '26','classID' => '3']);
        student_classes::create(['id' => '26','classID' => '4']);
        student_classes::create(['id' => '27','classID' => '2']);
        student_classes::create(['id' => '27','classID' => '3']);
        student_classes::create(['id' => '27','classID' => '4']);
        student_classes::create(['id' => '28','classID' => '2']);
        student_classes::create(['id' => '28','classID' => '3']);
        student_classes::create(['id' => '29','classID' => '2']);
        student_classes::create(['id' => '30','classID' => '2']);
        student_classes::create(['id' => '30','classID' => '3']);
        student_classes::create(['id' => '31','classID' => '2']);
        student_classes::create(['id' => '31','classID' => '3']);
        student_classes::create(['id' => '31','classID' => '4']);
        student_classes::create(['id' => '32','classID' => '3']);
        student_classes::create(['id' => '32','classID' => '4']);
        student_classes::create(['id' => '33','classID' => '3']);
        student_classes::create(['id' => '34','classID' => '3']);
        student_classes::create(['id' => '34','classID' => '4']);
        student_classes::create(['id' => '35','classID' => '4']);
        student_classes::create(['id' => '36','classID' => '3']);
        student_classes::create(['id' => '36','classID' => '4']);
        student_classes::create(['id' => '37','classID' => '2']);
        student_classes::create(['id' => '37','classID' => '3']);
        student_classes::create(['id' => '37','classID' => '4']);
        student_classes::create(['id' => '38','classID' => '1']);
        student_classes::create(['id' => '38','classID' => '2']);
        student_classes::create(['id' => '38','classID' => '3']);
        student_classes::create(['id' => '38','classID' => '4']);
    }
}

class student_preferencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('student_preferences')->delete();

        student_preferences::create(['id' => '1','python' => '1','java' => '1','c' => '9','teamstyle' => '2']);
        student_preferences::create(['id' => '2','python' => '1','java' => '1','c' => '9','teamstyle' => '1']);
        student_preferences::create(['id' => '3','python' => '1','java' => '9','c' => '1','teamstyle' => '3']);
        student_preferences::create(['id' => '4','python' => '1','java' => '9','c' => '1','teamstyle' => '2']);
        student_preferences::create(['id' => '5','python' => '9','java' => '1','c' => '1','teamstyle' => '1']);
        student_preferences::create(['id' => '6','python' => '9','java' => '1','c' => '1','teamstyle' => '3']);
        student_preferences::create(['id' => '7','python' => '5','java' => '1','c' => '1','teamstyle' => '2']);
        student_preferences::create(['id' => '8','python' => '5','java' => '1','c' => '1','teamstyle' => '1']);
        student_preferences::create(['id' => '9','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '10','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '11','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '12','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '13','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '14','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '15','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '16','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '17','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '18','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '19','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '20','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '21','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '22','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '23','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '24','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '25','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '26','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '27','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '28','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '29','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '30','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '31','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '32','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '33','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '34','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '35','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);
        student_preferences::create(['id' => '36','python' => '4','java' => '4','c' => '4','teamstyle' => '3']);
        student_preferences::create(['id' => '37','python' => '4','java' => '4','c' => '4','teamstyle' => '2']);
        student_preferences::create(['id' => '38','python' => '4','java' => '4','c' => '4','teamstyle' => '1']);


    }
}

class teamTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('team')->delete();

        team::create(['teamName' => 'Flying Circus','competition' => '1']);
        team::create(['teamName' => 'Bladed Maze','competition' => '1']);
        team::create(['teamName' => 'Random Namers','competition' => '2']);
        team::create(['teamName' => 'Team 404','competition' => '2']);
        team::create(['teamName' => 'Out of Time','competition' => '3']);
        team::create(['teamName' => 'Seedy Fellows','competition' => '3']);
    }
}

class team_contentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('team_contents')->delete();

        team_contents::create(['teamID' => '1','studentID' => '1']);
        team_contents::create(['teamID' => '1','studentID' => '2']);
        team_contents::create(['teamID' => '1','studentID' => '3']);
        team_contents::create(['teamID' => '1','studentID' => '4']);
        team_contents::create(['teamID' => '1','studentID' => '5']);


        team_contents::create(['teamID' => '2','studentID' => '6']);
        team_contents::create(['teamID' => '2','studentID' => '7']);
        team_contents::create(['teamID' => '2','studentID' => '8']);
        team_contents::create(['teamID' => '2','studentID' => '9']);
        team_contents::create(['teamID' => '2','studentID' => '10']);

        team_contents::create(['teamID' => '3','studentID' => '1']);
        team_contents::create(['teamID' => '3','studentID' => '2']);
        team_contents::create(['teamID' => '3','studentID' => '11']);

        team_contents::create(['teamID' => '4','studentID' => '12']);
        team_contents::create(['teamID' => '4','studentID' => '13']);
        team_contents::create(['teamID' => '4','studentID' => '14']);

        team_contents::create(['teamID' => '5','studentID' => '1']);
        team_contents::create(['teamID' => '5','studentID' => '15']);
        team_contents::create(['teamID' => '5','studentID' => '16']);
        team_contents::create(['teamID' => '5','studentID' => '17']);

        team_contents::create(['teamID' => '6','studentID' => '18']);
        team_contents::create(['teamID' => '6','studentID' => '19']);
        team_contents::create(['teamID' => '6','studentID' => '20']);
        team_contents::create(['teamID' => '6','studentID' => '21']);
    }

}

class student_competitionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('student_competition')->delete();

        student_competition::create(['studentID' => '1','compID' => '1']);
        student_competition::create(['studentID' => '2','compID' => '1']);
        student_competition::create(['studentID' => '3','compID' => '1']);
        student_competition::create(['studentID' => '4','compID' => '1']);
        student_competition::create(['studentID' => '5','compID' => '1']);
        student_competition::create(['studentID' => '6','compID' => '1']);
        student_competition::create(['studentID' => '7','compID' => '1']);
        student_competition::create(['studentID' => '8','compID' => '1']);
        student_competition::create(['studentID' => '9','compID' => '1']);
        student_competition::create(['studentID' => '10','compID' => '1']);
        student_competition::create(['studentID' => '11','compID' => '1']);
        student_competition::create(['studentID' => '12','compID' => '1']);
        student_competition::create(['studentID' => '13','compID' => '1']);
        student_competition::create(['studentID' => '14','compID' => '1']);
        student_competition::create(['studentID' => '15','compID' => '1']);

        student_competition::create(['studentID' => '1','compID' => '2']);
        student_competition::create(['studentID' => '2','compID' => '2']);
        student_competition::create(['studentID' => '3','compID' => '2']);
        student_competition::create(['studentID' => '4','compID' => '2']);
        student_competition::create(['studentID' => '5','compID' => '2']);
        student_competition::create(['studentID' => '16','compID' => '2']);
        student_competition::create(['studentID' => '17','compID' => '2']);
        student_competition::create(['studentID' => '18','compID' => '2']);
        student_competition::create(['studentID' => '19','compID' => '2']);
        student_competition::create(['studentID' => '20','compID' => '2']);
        student_competition::create(['studentID' => '21','compID' => '2']);
        student_competition::create(['studentID' => '22','compID' => '2']);
        student_competition::create(['studentID' => '23','compID' => '2']);
        student_competition::create(['studentID' => '24','compID' => '2']);
        student_competition::create(['studentID' => '25','compID' => '2']);
    }
}