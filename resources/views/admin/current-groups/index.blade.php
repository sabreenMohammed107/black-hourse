@extends('layout.web')

@section('title', 'المجموعات الحالية')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">بيانات الرئيسية</h3>


        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
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
                        <th>الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $index => $row)
                    <tr>
                        <td></td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{$row->branch->name ?? ''}}</td>
                        <td>{{$row->room->room_no ?? ''}}</td>
                        <td>{{$row->course->name ?? ''}}</td>
                          <td>{{$row->trainer->name ?? ''}} </td>
                        <td>{{date('d-m-Y', strtotime($row->start_date))}} </td>
                        <td>{{date('d-m-Y', strtotime($row->end_date))}}</td>
                        <td> {{$row->fees}}</td>
                        <td>{{$row->discount_per}}</td>
                        <td>{!!$row->course->note ?? ''!!}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('current-groups.show', $row->id) }}" class="btn btn-default"><i
                                    class="fa fa-eye" title="عرض"></i></a>
                                                </div>
                        </td>
                          <!-- Delete Modal -->


                    </tr>

                    @endforeach
                </tbody>
            </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
