<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Course;
use App\Models\Deploma_student;
use App\Models\Exeption;
//new
use App\Models\Exeption_type;
use App\Models\Followup_center;
use App\Models\Followup_type;
use App\Models\Invoice;
use App\Models\Request_status;
use App\Models\Round;
use App\Models\Round_day;
use App\Models\Sale_funnel;
use App\Models\Student;
use App\Models\Student_round;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GeneralStudentsController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Student $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.general-students.';
        $this->routeName = 'general-students.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Student::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $cities = City::all();
        $funnels = Sale_funnel::all();
        $status = Request_status::all();
        return view($this->viewName . 'add', compact('companies', 'cities', 'funnels', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->except(['_token', 'register_date']);

        $input['register_date'] = Carbon::parse($request->get('register_date'));

        Student::create($input);
        return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Student::where('id', '=', $id)->first();
        $studentSS = Student::where('id', '=', $id)->first();
        $companies = Company::all();
        $cities = City::all();
        $funnels = Sale_funnel::all();
        $status = Request_status::all();
        $studentRounds = Student_round::where('student_id', $id)->get();
        $rounds = Student_round::where('student_id', $id)->get();
        $deplomas = Deploma_student::where('student_id', $id)->get();
        $followups = Followup_center::where('student_id', $id)->where('followup_flag', 2)->get();
        $callcenter = Followup_center::where('student_id', $id)->where('followup_flag', 1)->get();
        $fullowupTypes = Followup_type::all();
        $filterd_rounds = array();
        $roundDays = Round_day::where('round_id', $id)->get();
        $folowRounds = Round::all();
        $finance = Invoice::where('student_id', $id)->whereIn('payment_type_id',[101,102])->get();
        $roundsinFin = Invoice::where('student_id', $id)->whereNotNull('round_id')->whereIn('payment_type_id',[101,102])->distinct()->pluck('round_id');

        foreach ($roundsinFin as $round) {
            $obj = new Collection();
            $obj->roundsFinance = array();
            // $obj->course=new Round();
            foreach ($finance as $fin) {
                if ($fin->round_id === $round) {

                    array_push($obj->roundsFinance, $fin);

                }
            }
            $roundsinFin = Invoice::where('student_id', $id)->where('round_id', $round)->whereIn('payment_type_id',[101,102])->orderBy("created_at", "Desc")->first();
            $obj->student =$id;
            $obj->course = Round::where('id', $round)->first();

            array_push($filterd_rounds, $obj);

        }

        $exeptions = Exeption::where('student_id', $id)->get();
        $exeptionTypes = Exeption_type::all();
        return view($this->viewName . 'view', compact('row', 'studentSS', 'deplomas', 'callcenter', 'folowRounds', 'studentRounds', 'rounds', 'roundDays', 'exeptions', 'exeptionTypes', 'followups', 'fullowupTypes', 'companies', 'cities', 'funnels', 'status', 'filterd_rounds'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $row = Student::where('id', '=', $id)->first();
        $companies = Company::all();
        $cities = City::all();
        $funnels = Sale_funnel::all();
        $status = Request_status::all();
        return view($this->viewName . 'edit', compact('row', 'companies', 'cities', 'funnels', 'status'));
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
        $input = $request->except(['_token', 'register_date']);

        $input['register_date'] = Carbon::parse($request->get('register_date'));

        $this->object::findOrFail($id)->update($input);
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
        $row = Student::where('id', $id)->first();
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
