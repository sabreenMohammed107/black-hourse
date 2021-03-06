<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Student;
use App\Models\Student_round;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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
        //
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
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'round_id']);
            if ($request->get('wait') && $request->get('wait') == 1) {
                $input['request_status_id'] = 4;

            } else {

                $input['request_status_id'] = 3;

            }
            $student = Student::create($input);

            $round = Round::where('id', $request->get('round_id'))->first();
            $values = [
                'round_id' => $request->get('round_id'),
                'student_id' => $student->id,
                // 'status_id' => 3,
                'register_date' => Carbon::now()->toDateTimeString(),
                'total_fees' => $round->fees,
                'total_paid' => 0,

            ];
            if ($request->get('wait') && $request->get('wait') == 1) {
                $values['status_id'] = 4;

            } else {

                $values['status_id'] = 3;

            }

            Student_round::create($values);
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', '???? ?????????? ??????????');
        } catch (\Throwable$e) {
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
        $row = Student_round::where('id', $id)->first();
        // Delete File ..

        try {

            $row->delete();
            return redirect()->back()->with('flash_success', '???? ?????????? ?????????? !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', '?????? ???????????? ???????????? ?????????? ?????? ..???? ???????? ??????????');
        }
    }

    public function addStudent(Request $request)
    {
        $round = Round::where('id', $request->get('round_id'))->first();
        $input = [
            'round_id' => $request->get('round_id'),
            'student_id' => $request->get('student_id'),
            'status_id' => 3,
            'register_date' => Carbon::now()->toDateTimeString(),
            'total_fees' => $round->fees,
            'total_paid' => 0,

        ];

        $student = Student::where('id', $request->get('student_id'))->first();
        if ($request->get('wait') && $request->get('wait') == 1) {
            $input['status_id'] = 4;
            $student->request_status_id = 4;
            $student->update(); // dd(1);

        } else {
            $student->request_status_id = 3;
            $input['status_id'] = 3;
            $student->update();
            // dd($student);

        }
        Student_round::create($input);

        return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', '???? ?????????? ??????????');
    }

    public function connectStudent(Request $request)
    {
        $round = Round::where('id', $request->get('round_id'))->first();
        $input = [
            'round_id' => $request->get('round_id'),
            'student_id' => $request->get('student_id'),
            'status_id' => 3,

        ];

        $student = Student::where('id', $request->get('student_id'))->first();
if($student){
    $student->request_status_id = 3;

    $student->update();
}


        $sudent_round = Student_round::where('round_id', '=', $request->get('round_id'))->where('student_id', '=', $request->get('student_id'))->first();
        if($sudent_round){
            $sudent_round->status_id = 3;
            $sudent_round->update();
        }


        return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', '???? ?????????? ??????????');
    }
    public function addStudentDepolma(Request $request)
    {
        $round = Round::where('id', $request->get('round_id'))->first();
        $input = [
            'round_id' => $request->get('round_id'),
            'student_id' => $request->get('student_id'),
            // 'status_id' => 3,
            'register_date' => Carbon::now()->toDateTimeString(),
            'deploma_flag' => 1,

        ];
        $student = Student::where('id', $request->get('student_id'))->first();
        if ($request->get('wait') && $request->get('wait') == 1) {
            // $input['status_id']=4;
            $student->request_status_id = 4;
            $student->update(); // dd(1);

        } else {
            $student->request_status_id = 3;
            // $input['status_id']=3;
            $student->update();
            // dd($student);

        }
        Student_round::create($input);
        return redirect()->route($this->routeName . 'show', $request->get('round_id'))->with('flash_success', '???? ?????????? ??????????');

    }
}
