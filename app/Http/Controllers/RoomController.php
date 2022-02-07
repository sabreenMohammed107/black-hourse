<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Room;
use App\Models\Round;
use App\Models\Round_day;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Room $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.room.';
        $this->routeName = 'room.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Room::orderBy("created_at", "Desc")->get();
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
        return view($this->viewName . 'add', compact('branches'));
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

        Room::create($input);
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
        $row = Room::where('id', '=', $id)->first();
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

        return view($this->viewName . 'view1', compact('row', 'branches', 'data'));
    }
    public function fullCalender(Request $request)
    {
        $data = [];

        // if ($request->ajax()) {
        $rows = Round_day::all();
        foreach ($rows as $key => $value) {


            $obj = new Collection();
            $obj->title = $value->round_id;
            $obj->start = 'Sat Jan 29 2022 22:41:49'; // 1975-05-21 22:00:00
            $obj->end = 'Sat Jan 29 2022 22:41:49';
            $obj->backgroundColor = '#f56954'; //red
            $obj->borderColor = '#f56954'; //red
            $obj->allDay = true;

            array_push($data, ['title' => $value->round_id,
                'start' => 'Sat Jan 29 2022 22:41:49', // 1975-05-21 22:00:00
                'end' => 'Sat Jan 29 2022 22:41:49',
                'backgroundColor' => '#f56954', //red
                'borderColor' => '#f56954', //red
                'allDay' => true]);
        }

        \Log::info($data);
        return response()->json($data);


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Room::where('id', '=', $id)->first();
        $branches = Branch::all();
        return view($this->viewName . 'edit', compact('row', 'branches'));
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
        $row = Room::where('id', $id)->first();
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
