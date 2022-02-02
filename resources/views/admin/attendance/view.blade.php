@extends('layout.web')

@section('title', 'حضور المجموعات الحالية')

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
                                    <th>رقم المحاضرة</th>
                                    <th>تاريخ المحاضرة </th>
                                    <th>ملاحظات </th>
                                    <th>تسجيل الحضور</th>
                                    <th>طباعة الغياب</th>
                                    <th>الغاء المحاضرة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $index => $session)
                                <tr>
                                    <td></td>
                                    <td>{{ $index + 1 }}</td>
    <td>{{$session->session_no}}</td>
    <td>{{date('d-m-Y', strtotime($session->session_date))}}</td>
    <td>{{$session->notes}} </td>
    <td>
        <div class="btn-group">
            <a href="{{ route('attendance.edit', $session->id) }}" class="btn btn-default"><i class="fa fa-edit" title="الحضور"></i></a>
        </div>
    </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-default" ><i class="fa fa-print" title="طباعة"></i></button>
        </div>
    </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#del{{$session->id}}"><i class="fa fa-times" title="عرض"></i></button>
        </div>
    </td>
    <!-- Delete Modal -->
<div class="modal fade dir-rtl" id="del{{$session->id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-fire text-danger"></i></h3>
                <h4 class="text-danger">هل تريد الغاء المحاضرة ؟</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger">تأكيد</button>
            </div>
        </div>
    </div>
</div>
</tr>

@endforeach




                        <!-- Delete Modal -->



                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
{{-- </div> --}}
<!-- /.row -->


@endsection
