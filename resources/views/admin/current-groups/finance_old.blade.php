<div class="box-body">
    <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
    data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                       <thead>
                        <tr>
                            <th data-field="state" data-checkbox="false"></th>
                            <th data-field="id">#</th>
                            <th>رقم الفاتورة </th>
                            <th> اسم الطالب</th>
                            <th>تاريخ الفاتورة </th>
                            <th> نوع الدفع </th>
                            <th>الخزنة</th>
                            <th>اسم الدورة</th>
                            <th>رقم المجموعة</th>
                            <th>المبلغ المطلوب </th>
                            <th>المبلغ المدفوع</th>
                            <th>المبلغ المتبقى</th>
                            <!--<th>ملاحظات</th>-->
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finance as $index => $fin)
<?php
        $total_fees_new = App\Models\Invoice::where('student_id', $fin->student_id)->where('round_id', $fin->round_id)->whereIn('payment_type_id',[101,102])->sum('total_fees_new');
?>
                        <tr>
                            <td></td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{$fin->invoice_no}}</td>
                            <td>{{$fin->student->name ?? ''}}</td>
                            <td>{{date('d-m-Y', strtotime($fin->invoice_date))}}</td>
                            <td>{{$fin->type->payment_type ?? ''}}</td>
                            <td>{{$fin->cashbox->name ?? ''}}</td>
                            <td>{{$fin->round->course->name ?? ''}}</td>
                            <td>{{$fin->round->round_no ?? ''}}</td>
                            <td>{{$fin->total_required_fees}}</td>
                            <td>{{$total_fees_new}}</td>
                            <td>{{$fin->total_fees_new}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('fin-round-data', $fin->id) }}" class="btn btn-default"><i class="fa fa-edit" title="تعديل"></i></a>
                                    {{-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#del{{ $fin->id }}"><i class="fa fa-times" title="حذف"></i></button> --}}
                                </div>
                            </td>

                        </tr>

                        @endforeach

                <!-- Delete Modal -->



        </tbody>
    </table>
</div>
