<div class="box-body">
    <div class="col-12" id="accordion">
        @foreach ($filterd_rounds as $index=>$round)
        <?php
        $total_fees_new = App\Models\Invoice::where('student_id', $round->student)->where('round_id', $round->course->id)->whereIn('payment_type_id',[101,102])->sum('total_fees_new');
?>

        <div class="card card-primary card-outline">
            <a class="d-block w-100" data-toggle="collapse" href="#collapse{{$index+1}}">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        {{$index+1}}. {{$round->course->course->name ?? ''}}
                        <span class="text-white mr-3 ml-3">إجمالي المدفوع :<span> {{$total_fees_new ?? ''}} </span></span>
                        <span class="text-warning">إجمالي المتبقي :<span> {{$round->course->fees_after_discount -$total_fees_new ?? ''}}</span></span>
                    </h4>
                </div>
            </a>
            <div id="collapse{{$index+1}}" class="collapse fade" data-parent="#accordion">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>رقم فاتورة</th>
                                <th>اسم الدورة</th>
                                <th>الفرع</th>
                                <th>رقم المجموعة</th>
                                <th>نوع الدفع</th>
                                <th> تاريخ الدفع</th>
                                <th>القيمة</th>
                                <th>الموظف المستلم</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($round->roundsFinance as $fin)


                            <tr>
                                <td>001</td>
                                <td>{{$fin->invoice_no}}</td>
                                <td>{{$round->course->name ?? ''}}</td>
                                <td>{{$fin->cashbox->branch->name ?? ''}}</td>
                                <td>{{$fin->round->round_no ?? ''}}</td>
                                <td>حجز دورة</td>
                                <td>{{date('d-m-Y', strtotime($fin->invoice_date))}}</td>
                                <td>{{$fin->total_fees_new}}</td>
                                <td>أحمد السيد</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach

    </div>


</div>
