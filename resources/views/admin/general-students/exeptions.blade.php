<div class="box-body">


    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>

                            <th> الفرع</th>
                            <th>اسم الدورة</th>
                            <th>رقم المجموعة</th>

                            <th>تاريخ التسجيل </th>
                            <th>نوع الإستثناء </th>
                            <th>حالة الطلب </th>
                            <th>ملاحظات </th>

            </tr>
        </thead>
        <tbody>

                @foreach ($exeptions as $index => $row)
                            <tr>
                                <td></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row->round->branch->name ?? '' }}</td>
                                <td>{{ $row->round->course->name ?? '' }}</td>
                                <td>{{ $row->round->round_no ?? '' }}</td>

                                <td>{{ date('d-m-Y', strtotime($row->exeption_date)) }} </td>
                                <td>{{ $row->type->exeption_name ?? '' }}</td>
                                <td>@if ($row->exeption_status == 0) لم يتم اتخاذ اجراء @elseif ($row->exeption_status == 1) تمت الموافقه @else تم الرفض @endif</td>
                                <td>{{ $row->notes }} </td>
            </tr>



            @endforeach

        </tbody>


        </tbody>
    </table>

</div>



