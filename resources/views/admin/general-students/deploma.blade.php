<div class="box-body">


    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>
                <th>اسم الدبلومة</th>

                <th>تاريخ التسجيل</th>

                <th>تكلفة الدبلومة</th>
                <th>المبلغ المدفوع</th>
                <th>المبلغ المتبقى</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($deplomas) --}}
            @foreach ($deplomas as $index => $row)
            {{-- @foreach ($row->attend as $attend) --}}
            <tr>
                <td></td>
                <td>{{ $index + 1 }}</td>
                <td> {{$row->deploma->name ?? ''}}</td>

                <td>{{date('d-m-Y', strtotime($row->register_date))}}</td>

                <td>{{$row->total_fees ?? ''}}</td>
                <td>{{$row->total_paid}}</td>
                <td>{{$row->total_fees - $row->total_paid}}</td>
                <td>بدأت</td>
            </tr>
            {{-- @endforeach --}}


            @endforeach

        </tbody>


        </tbody>
    </table>

</div>



