<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Exeption;
use App\Models\Exeption_type;
use App\Models\Followup_center;
use App\Models\Followup_type;
use App\Models\Room;
use App\Models\Round;
use App\Models\Round_day;
use App\Models\Student_round;
use App\Models\Trainer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
        return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', 'تم الحفظ بنجاح');
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
        return view($this->viewName . 'view', compact('row', 'branches', 'rooms', 'courses', 'roundSS', 'trainers', 'students', 'roundDays', 'exeptions', 'exeptionTypes', 'followups','fullowupTypes'));

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
        return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', 'تم الحفظ بنجاح');
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
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
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
        return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

    }

    public function reject($id)
    {
        $row = Exeption::where('id', $id)->first();
        $row->update(['exeption_status' => 2]);
        return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');
    }
}
