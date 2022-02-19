<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Round_day;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
class DailyScheduleControler extends Controller
{

    protected $viewName;
    protected $routeName ;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->viewName = 'admin.daily-schedule.';
    $this->routeName = 'daily-schedule.';
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches=Branch::orderBy("created_at", "Desc")->get();
        // $data = array();
        // $data = json_encode($data);

         //data to calender
         $row = Room::where('id', '=', 1)->first();
         $data = array();


        //   dd($data);

         $data = json_encode($data);
        return view($this->viewName.'index', compact('branches','data'));
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
        $row = Room::where('id', '=', $request->get('room_id'))->first();
        $branches = Branch::all();
        //data to calender
        $data = array();
        $sessions = $row->sessions;
        $rows = $row->days;


        foreach ($sessions as $session) {

            $day = Round_day::where('round_id', $session->round_id)->get();

            foreach ($day as $value) {

                 if(Carbon::parse($session->session_date)->dayOfWeek == $value->day_id){

                    array_push($data,
                    ['title' => $value->round->course->name,
                        'start' => Carbon::parse(date('Y-m-d', strtotime($session->session_date)) . ' ' . $value->from , 'GMT')->subHours(2), // 1975-05-21 22:00:00
                        'end' => Carbon::parse(date('Y-m-d', strtotime($session->session_date)) . ' ' . $value->to , 'GMT')->subHours(2),
                        'backgroundColor' => '#f56954', //red
                        'borderColor' => '#f56954', //red
                        'allDay' => false,
                    ]);
                }




             if(Carbon::parse($session->session_date)->dayOfWeek==0 && $value->day_id==7){
                array_push($data,
                ['title' => $value->round->course->name,
                    'start' => Carbon::parse(date('Y-m-d', strtotime($session->session_date)) . ' ' . $value->from , 'GMT')->subHours(2), // 1975-05-21 22:00:00
                    'end' => Carbon::parse(date('Y-m-d', strtotime($session->session_date)) . ' ' . $value->to , 'GMT')->subHours(2),
                    'backgroundColor' => '#f56954', //red
                    'borderColor' => '#f56954', //red
                    'allDay' => false,
               ]);
             }
            }

        }
        //  dd($data);

        $data = json_encode($data);

        return view($this->viewName . 'index', compact('row', 'branches', 'data'));
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
        //
    }
    public function fetchRoom(Request $request){
        $data = [];

        if (!empty($request->get('value'))) {

            $data = Room::where('branch_id', '=', $request->get('value'))->get();
        }

        $output = '<option value="">..... </option>';
        foreach ($data as $row) {

            $output .= '<option value="' . $row->id . '">' . $row->room_no . '</option>';
        }

        echo $output;
    }
}
