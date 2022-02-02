<div class="box-body">


    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>
                <th>اسم الدورة</th>
                <th>الفرع</th>
                <th>رقم المجموعة</th>
                <th>تاريخ البدء</th>
                <th>حالة المجموعة</th>
                <th>تاريخ التسجيل</th>
                <th>حالة الحجز</th>
                <th>تكلفة الدورة</th>
                <th>المبلغ المدفوع</th>
                <th>قيمة الشهادة المدفوعة</th>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($studentRounds) --}}
            @foreach ($studentRounds as $index => $row)
            {{-- @foreach ($row->attend as $attend) --}}
            <tr>
                <td></td>
                <td>{{ $index + 1 }}</td>
                <td> {{$row->round->course->name ?? ''}}</td>
                <td> {{$row->round->branch->name ?? ''}}</td>
                <td>{{$row->round->round_no ?? ''}}</td>
                <td>{{date('d-m-Y', strtotime($row->round->start_date))}}</td>
                <td>{{$row->round->status->round_status ?? ''}}</td>
                 <td>{{date('d-m-Y', strtotime($row->register_date))}}</td>
                <td>{{$row->student->status->request_status ?? ''}}</td>
                <td>{{$row->round->course->fees ?? ''}}</td>
                <td>{{$row->total_paid}}</td>
                <td>certficate</td>
                <td>{{$row->note}}</td>
            </tr>
            {{-- @endforeach --}}


            @endforeach

        </tbody>


        </tbody>
    </table>

</div>



