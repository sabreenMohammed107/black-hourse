<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cashbox;
use App\Models\Course;
use App\Models\Exeption;
use App\Models\Exeption_type;
use App\Models\Followup_center;
use App\Models\Followup_type;
use App\Models\Invoice;
use App\Models\Payment_type;
use App\Models\Room;
use App\Models\Round;
use App\Models\Round_day;
use App\Models\Student;
use App\Models\Student_round;
use App\Models\Trainer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
class CurrentGroupsController extends Controller
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
        $this->viewName = 'admin.current-groups.';
        $this->routeName = 'current-groups.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Round::where('status_id', '=', 2)->orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
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
        $input = $request->except(['_token']);
        $input['exeption_status'] = 0;
        Exeption::create($input);
        return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', '???? ?????????? ??????????');
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
        $roundSS = Round::where('id', '=', $id)->first();
        $branches = Branch::all();
        $rooms = Room::all();
        $courses = Course::all();
        $trainers = Trainer::all();
        $students = Student_round::where('round_id', $id)->get();
        $roundDays = Round_day::where('round_id', $id)->get();
        $exeptions = Exeption::where('round_id', $id)->get();
        $exeptionTypes = Exeption_type::all();
        $followups = Followup_center::where('round_id', $id)->where('followup_flag', 2)->get();
        $fullowupTypes=Followup_type::all();
        $finance=Invoice::where('round_id',$id)->get();
        $filterd_rounds = array();
        $finance = Invoice::where('round_id', $id)->whereIn('payment_type_id',[101,102])->get();
        $roundsinFin = Invoice::where('round_id', $id)->whereNotNull('student_id')->whereIn('payment_type_id',[101,102])->distinct()->pluck('student_id');

        foreach ($roundsinFin as $stud) {
            $obj = new Collection();
            $obj->roundsFinance = array();
            // $obj->course=new Round();
            foreach ($finance as $fin) {
                if ($fin->student_id === $stud) {

                    array_push($obj->roundsFinance, $fin);

                }
            }
            $roundsinFin = Invoice::where('student_id', $stud)->where('round_id', $id)->whereIn('payment_type_id',[101,102])->orderBy("created_at", "Desc")->first();
            $obj->roundNow =$id;
            $obj->courseStudent = Student::where('id', $stud)->first();

            array_push($filterd_rounds, $obj);

        }
        return view($this->viewName . 'view', compact('row', 'branches', 'rooms', 'courses', 'roundSS', 'trainers', 'students', 'roundDays', 'exeptions', 'exeptionTypes', 'followups','fullowupTypes','finance','filterd_rounds'));

    }

    public function showFinData($id){
        $row = Invoice::where('id', '=', $id)->first();
        $branches = Branch::whereHas('cashbox', function ($query) use ($row) {
            $query->where('id', $row->cashbox_id);
        })->get();
        $types = Payment_type::all();
        $cashboxes = Cashbox::all();

        $courses = Course::whereHas('rounds', function ($query) use ($row) {
            $query->where('id', $row->round_id);
        })->get();
        $rounds = Round::where('status_id', '!=', 2)->get();
        $students = Student_round::where('round_id', '=', $row->round_id)->get();
        return view($this->viewName . 'showFin', compact('row', 'types', 'branches', 'rounds', 'students', 'cashboxes', 'courses'));

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
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);
        $this->object::findOrFail($id)->update($input);
        return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', '???? ?????????? ??????????');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Exeption::where('id', $id)->first();
        // Delete File ..
        try {

            $row->delete();
            return redirect()->back()->with('flash_success', '???? ?????????? ?????????? !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', '?????? ???????????? ???????????? ?????????? ?????? ..???? ???????? ??????????');
        }
    }
    public function acceptExeptions()
    {
        $exeptions = Exeption::get();
        return view($this->viewName . 'acceptExeptions', compact('exeptions'));
    }

    public function accept($id)
    {
        $row = Exeption::where('id', $id)->first();
        $row->update(['exeption_status' => 1]);
        return redirect()->back()->with('flash_success', '???? ?????????? ?????????? !');

    }

    public function reject($id)
    {
        $row = Exeption::where('id', $id)->first();
        $row->update(['exeption_status' => 2]);
        return redirect()->back()->with('flash_success', '???? ?????????? ?????????? !');
    }
}
