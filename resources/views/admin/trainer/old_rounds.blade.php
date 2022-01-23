<div class="box-body">



    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th data-field="id">#</th>
                <th> الفرع</th>
                <th> رقم القاعة</th>
                <th>اسم الدورة</th>
                <th>المدرب</th>
                <th> تاريخ البداية</th>
                <th>تاريخ النهاية</th>
                <th>التكلفة</th>
                <th>الخصم %</th>
                <th>ملاحظات</th>
                {{-- <th>الاجراءات</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($row->rounds_old as $index => $round)
            <tr>
                <td></td>
                <td>{{ $index + 1 }}</td>
                <td>{{$round->branch->name ?? ''}}</td>
                <td>{{$round->room->room_no ?? ''}}</td>
                <td>{{$round->course->name ?? ''}}</td>
                  <td>{{$round->trainer->name ?? ''}} </td>
                <td>{{date('d-m-Y', strtotime($round->start_date))}} </td>
                <td>{{date('d-m-Y', strtotime($round->end_date))}}</td>
                <td> {{$round->fees}}</td>
                <td>{{$round->discount_per}}</td>
                <td>{!!$round->course->note ?? ''!!}</td>
                {{-- <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delround{{ $round->id }}"><i class="fa fa-times" title="حذف"></i></button>
                    </div>
                </td> --}}
                  <!-- Delete Modal -->

    </div>
            </tr>

            @endforeach

        </tbody>
    </table>

</div>


