<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Round;
use App\Models\Session;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName ;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Attendance $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.attendance.';
    $this->routeName = 'attendance.';
    }
     /**attendance
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Round::where('status_id',2)->orderBy("created_at", "Desc")->get();

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
       //invoice items
       $count = $request->counter;
       $details = [];

       for ($i = 1; $i <= $count; $i++) {
           $row=Attendance::where('session_id', $request->get('session_id'))
           ->where('student_round_id',$request->get('student_round_id' . $i))->first();
// dd($request->get('session_id'));
           $detail = [

               'session_id' => $request->get('session_id'),

            //    'student_round_id' => $request->get('student_round_id' . $i),

               'is_atend' => $request->get('is_atend' . $i),
               'room_rent_fees' => $request->get('room_rent_fees'. $i),

               'room_rent_paid' => $request->get('room_rent_paid' . $i),

               'certificate_fees' => $request->get('certificate_fees' . $i),

               'certificate_paid' => $request->get('certificate_paid' . $i),
               'notes' => $request->get('notes'. $i),


           ];

           $row->update($detail);
        }


        return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

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
        $sessions = Session::where('round_id', '=', $id)->get();
        return view($this->viewName . 'view', compact('row','sessions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rowSession = Session::where('id', '=', $id)->first();
        $studentsAttendance = Attendance::where('session_id', '=', $id)->get();
        return view($this->viewName . 'edit', compact('rowSession','studentsAttendance'));
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
