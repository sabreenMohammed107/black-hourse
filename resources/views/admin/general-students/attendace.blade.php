<div class="box-body">



    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>
                <th>اسم الدورة</th>
                <th>اسم الفرع</th>
                <th>رقم المجموعة</th>
                <th>عددمرات الحضور</th>
                <th>عدد مات الغياب</th>

                <th>طباعه</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rounds as $index => $row)
            <?php
 $attend=count(App\Models\Attendance::where('is_atend',1)->where('student_round_id',$row->id)->get());
 $abcent=count(App\Models\Attendance::where('is_atend',2)->where('student_round_id',$row->id)->get());
            ?>
            <tr>
                <td></td>
                <td>{{ $index + 1 }}</td>
                <td>{{$row->round->course->name ?? ''}}</td>
                <td>{{$row->round->branch->name ?? ''}}</td>
                <td>{{$row->round->round_no ?? ''}}</td>
                <td>{{$attend}}</td>
                <td>{{$abcent}}</td>

                <td> <div class="btn-group">
                    <a href="{{ route('current-groups.show', $row->id) }}" class="btn btn-default"><i
                        class="fa fa-print" title="عرض"></i></a>
                                    </div></td>


            @endforeach

        </tbody>


        </tbody>
    </table>

</div>






