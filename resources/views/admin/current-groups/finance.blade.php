<div class="box-body">
    <div class="col-12" id="accordion">
        @foreach ($filterd_rounds as $index=>$studen)
        <?php
        $total_fees_new = App\Models\Invoice::where('student_id', $studen->courseStudent->id)->where('round_id', $studen->roundNow)->whereIn('payment_type_id',[101,102])->sum('total_fees_new');
?>
        <div class="card card-primary card-outline">
            <a class="d-block w-100" data-toggle="collapse" href="#collapse{{$index+1}}">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        {{$index+1}}. {{$studen->courseStudent->name ?? ''}}
                        <span class="text-white mr-3 ml-3">إجمالي المدفوع :<span> {{$total_fees_new ?? ''}} </span></span>
                        <span class="text-warning">إجمالي المتبقي :<span> {{$roundSS->fees_after_discount - $total_fees_new}}</span></span>
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
                                <th>اسم الطالب</th>
                                <th>الفرع</th>
                                <th>رقم المجموعة</th>
                                <th>نوع الدفع</th>
                                <th> تاريخ الدفع</th>
                                <th>القيمة</th>
                                <th>الموظف المستلم</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studen->roundsFinance as $index=>$fin)


                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$fin->invoice_no}}</td>
                                <td>{{$fin->student->name ?? ''}}</td>
                                <td>{{$fin->cashbox->branch->name ?? ''}}</td>
                                <td>{{$fin->round->round_no ?? ''}}</td>
                                <td>{{$fin->type->payment_type ?? ''}}</td>
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
