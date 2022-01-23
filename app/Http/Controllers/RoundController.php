<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Day;
use App\Models\Room;
use App\Models\Round;
use App\Models\Round_day;
use App\Models\Student;
use App\Models\Student_round;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoundController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Round $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.round.';
        $this->routeName = 'round.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Round::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $rooms = Room::all();
        $courses = Course::all();
        $trainers = Trainer::all();
        $days = Day::all();
        return view($this->viewName . 'add', compact('branches', 'rooms', 'courses', 'trainers', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'start_date', 'end_date', 'day_id', 'round_days']);

            $input['start_date'] = Carbon::parse($request->get('start_date'));

            $input['end_date'] = Carbon::parse($request->get('end_date'));

            // dd($arr[1]);
            $round = Round::create($input);
            $arr = [];
            if ($request->get('round_days')) {
                foreach ($request->get('round_days') as $roud) {
                    $arrIndex = explode(",", $roud);
                    array_push($arr, $arrIndex);
                }

                // $arr=explode(",",[$request->get('round_days')]);

                foreach ($arr as $key => $Day) {
                    $RoundDay = new Round_day();
                    $RoundDay->day_id = $Day[0];
                    $RoundDay->round_id = $round->id;
                    $RoundDay->from = $Day[1];
                    $RoundDay->to = $Day[2];
                    $RoundDay->save();

                }
            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
        } catch (\Throwable $e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Round::where('id', '=', $id)->first();
        $roundSS=Round::where('id', '=', $id)->first();
        $branches = Branch::all();
        $rooms = Room::all();
        $courses = Course::all();
        $trainers = Trainer::all();
        $students = Student_round::where('round_id', $id)->get();
        $allStudents = Student::all();
        $days = Day::all();
        $roundDays = Round_day::where('round_id', $id)->get();
        return view($this->viewName . 'view', compact('row', 'branches', 'rooms', 'courses','roundSS', 'trainers', 'students', 'allStudents', 'days','roundDays'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Round::where('id', '=', $id)->first();
        $branches = Branch::all();
        $rooms = Room::all();
        $courses = Course::all();
        $trainers = Trainer::all();
        $days = Day::all();
        $roundDays = Round_day::where('round_id', $id)->get();
        return view($this->viewName . 'edit', compact('row', 'branches', 'rooms', 'courses', 'trainers', 'roundDays', 'days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {

            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'start_date', 'end_date', 'day_id', 'round_days']);

            $input['start_date'] = Carbon::parse($request->get('start_date'));

            $input['end_date'] = Carbon::parse($request->get('end_date'));

            $this->object::findOrFail($id)->update($input);

            $arr = [];
            if ($request->get('round_days')) {
                foreach ($request->get('round_days') as $roud) {
                    $arrIndex = explode(",", $roud);
                    array_push($arr, $arrIndex);
                }


$days=[];

                foreach ($arr as $key => $Day) {

                    array_push($days, $Day[0]);



                }

$row = Round::where('id', '=', $id)->first();
                $row->days()->sync(array_values($days));
                foreach ($arr as $key => $Day) {

                $rr = Round_day::where('round_id', $id)->where('day_id', $Day[0])->first();
                if($rr){
                    if($Day[0]==$rr->day_id){
                        if(!empty($Day[1])){
                            $rr->from =$Day[1];
                        }
                        if(!empty($Day[2])){
                            $rr->to =$Day[2];
                        }



                        $rr->update();
                    }
                }


                }
            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
        } catch (\Throwable $e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
        return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Round::where('id', $id)->first();
        // Delete File ..

        try {

            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }
    }
}
