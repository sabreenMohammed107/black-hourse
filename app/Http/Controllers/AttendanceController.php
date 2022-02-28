<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Cashbox;
use App\Models\Financial_entry;
use App\Models\Invoice;
use App\Models\Round;
use App\Models\Session;
use App\Models\Student_round;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

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
        $rows = Round::where('status_id', 2)->orderBy("created_at", "Desc")->get();

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
            $row = Attendance::where('session_id', $request->get('session_id'))
                ->where('student_round_id', $request->get('student_round_id' . $i))->first();
            $detail = [

                'session_id' => $request->get('session_id'),

                'is_atend' => $request->get('is_atend' . $i),
                'room_rent_fees' => $request->get('room_rent_fees' . $i),

                'room_rent_paid' => $request->get('room_rent_paid' . $i),

                'certificate_fees' => $request->get('certificate_fees' . $i),

                'certificate_paid' => $request->get('certificate_paid' . $i),
                'notes' => $request->get('notes' . $i),

            ];

            $row->update($detail);
            //save in invoice
            $studentRound = Student_round::where('id', $request->get('student_round_id' . $i))->first();
            $session = Session::where('id', $request->get('session_id'))->first();
            $cashbox = Cashbox::where('branch_id', $studentRound->round->branch_id)->first();

            // save rent
            $max = Invoice::latest('invoice_no')->first();

        // $max = ($max != null && $max != 0) ? $max : 0;
        $max = ($max != null) ? intval($max['code']) : 0;
        $max++;

            $invoice = new Invoice();
            $invoice->invoice_no = $max;
            $invoice->invoice_date = Carbon::parse($session->session_date);
            $invoice->student_id = $studentRound->student_id;
            $invoice->round_id = $studentRound->round_id;
            $invoice->total_required_fees = $request->get('room_rent_fees' . $i);
            $invoice->total_fees_new = $request->get('room_rent_paid' . $i);
            $invoice->user_id = Auth::user()->id;
            $invoice->payment_type_id = 103;
            $invoice->notes = $request->get('notes' . $i);
            $invoice->system_notes = "test";
            if ($cashbox) {
                $invoice->cashbox_id = $cashbox->id;
            }
            if ($request->get('room_rent_paid' . $i) && $request->get('room_rent_paid' . $i) > 0) {
                $invoice->save();
            }


            //save finance_entry

            $finance = new Financial_entry();

            $finance->start_balance_date = Carbon::parse($session->session_date);
            $finance->positive = $request->get('room_rent_paid' . $i);
            $finance->negative = 0;
            $finance->invoice_id = $invoice->id;
            $finance->notes = $request->get('notes' . $i);
            if ($request->get('room_rent_paid' . $i) && $request->get('room_rent_paid' . $i) > 0) {
                $finance->save();
            }

//save certificate
$existInvoice=Invoice::where('student_id', $studentRound->student_id)->where('round_id', $studentRound->round_id)->where('payment_type_id',104)->first();
if($existInvoice){

}else{
    $max = Invoice::latest('invoice_no')->first();

    // $max = ($max != null && $max != 0) ? $max : 0;
    $max = ($max != null) ? intval($max['code']) : 0;
    $max++;
    $invoice = new Invoice();
    $invoice->invoice_no = $max;
    $invoice->invoice_date = Carbon::parse($session->session_date);
    $invoice->student_id = $studentRound->student_id;
    $invoice->round_id = $studentRound->round_id;
    $invoice->total_required_fees = $request->get('certificate_fees' . $i);
    $invoice->user_id = Auth::user()->id;
    $invoice->payment_type_id = 104;
    $invoice->notes = $request->get('notes' . $i);
    $invoice->system_notes = "test";
    if ($cashbox) {
        $invoice->cashbox_id = $cashbox->id;
    }

    if ($request->get('certificate_paid' . $i) && $request->get('certificate_paid' . $i) > 0) {
        $invoice->total_fees_new = $request->get('certificate_paid' . $i);
        $invoice->save();
    }


    //save finance_entry

    $finance = new Financial_entry();

    $finance->start_balance_date = Carbon::parse($session->session_date);
    $finance->positive = $request->get('room_rent_paid' . $i);
    $finance->negative = 0;
    $finance->invoice_id = $invoice->id;
    $finance->notes = $request->get('notes' . $i);
    if ($request->get('certificate_paid' . $i) && $request->get('certificate_paid' . $i) > 0) {
        $finance->save();
    }


}

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
        return view($this->viewName . 'view', compact('row', 'sessions'));
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
        $round = Round::where('id', $rowSession->round_id)->first();
        return view($this->viewName . 'edit', compact('rowSession', 'studentsAttendance', 'round'));
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
