@extends('layout.web')

@section('title', 'المجموعات الحالية')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">بيانات الرئيسية</h3>


        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
                    data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="false"></th>
                            <th>#</th>
                            <th>اسم الدورة</th>
                            <th> الفرع</th>
                            <th>رقم المجموعة</th>
                            <th>اسم الطالب</th>
                            <th>تاريخ التسجيل </th>
                            <th>نوع الإستثناء </th>
                            <th>حالة الطلب </th>
                            <th>ملاحظات </th>
                            <th>الاجراءات</th>
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
                                <td>{{ $row->student->name ?? '' }}</td>
                                <td>{{ date('d-m-Y', strtotime($row->exeption_date)) }} </td>
                                <td>{{ $row->type->exeption_name ?? '' }}</td>
                                <td>@if ($row->exeption_status == 0) لم يتم اتخاذ اجراء @elseif ($row->exeption_status == 1) تمت الموافقه @else تم الرفض @endif</td>
                                <td>{{ $row->notes }} </td>
                                <td>
                                    <div class="btn-group">
                                        <a data-toggle="modal" data-target="#exeption-accept{{ $row->id }}"
                                            class="btn btn-default"><i class="fa fa-check" title="موافقة"></i></a>
                                        <a data-toggle="modal" data-target="#exeption-reject{{ $row->id }}"
                                            class="btn btn-default"><i class="fa fa-times" title="رفض"></i></a>

                                    </div>
                                </td>
                                <!-- accept Modal -->
                                <div class="modal modal-info" id="exeption-accept{{ $row->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{ route('exeption-accept',$row->id) }}" method="POST">
                                            @csrf

                                            <div class="modal-content">
                                                <div class="modal-header ">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h5 class="modal-title" id="exampleModalLabel">تأكيد الموافقة على الاستثناء</h5>
                                                    </button>
                                                </div>
                                                <div class="modal-body bg-light">
                                                    <p><i class="fa fa-fire "></i></p>
                                                    <p>هل تريد الموافقة على الاستثناء ؟</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left"
                                                        data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-outline">حفظ </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                    <!-- reject Modal -->
                                    <div class="modal modal-danger" id="exeption-reject{{ $row->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('exeption-reject',$row->id) }}" method="POST">
                                                @csrf

                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                        <h5 class="modal-title" id="exampleModalLabel">تأكيد الرفض</h5>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-light">
                                                        <p><i class="fa fa-fire "></i></p>
                                                        <p>  هل تريد رفض الاستثناء ؟</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline pull-left"
                                                            data-dismiss="modal">الغاء</button>
                                                        <button type="submit" class="btn btn-outline">حفظ </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
