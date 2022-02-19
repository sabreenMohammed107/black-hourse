@extends('layout.web')

@section('title', 'الشركات')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="card-title"> عملاء غير مهتمين
            </h3>
            {{-- <a href="{{ route('company.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a> --}}
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">اسم الشركة</label>
                    <input type="text" class="form-control" id="" placeholder="{{ $row->name }}" disabled>
                </div>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
                    data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="false"></th>
                            <th data-field="id">#</th>
                            <th> اسم الطالب</th>
                            <th>رقم موبايل </th>
                            <th>ايميل</th>
                            <th>الفرع</th>

                            <th>وعاء مبيعات</th>
                            <th>السن</th>
                            <th>تاريخ التسجيل</th>
                            <th>الدورات المهتمين به</th>
                            <th>تاريخ أخر تواصل</th>
                            <th>نص التواصل</th>
                            <th>التواصل</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $row)
                            <tr>
                                <td></td>
                                <td>{{ $index + 1 }}</td>

                                <td> {{ $row->name }}</td>
                                <td> {{ $row->mobile }}</td>
                                <td> {{ $row->email }}</td>
                                <td>
                                    @foreach ($row->branches as $index => $branch)
                                        <label for="">{{ $branch->name }} - </label>
                                    @endforeach
                                </td>

                                <td>{{ $row->funnel->sale_funnel ?? '' }}
                                    {{-- @if ($row->funnel) --}}
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#edit{{$row->id}}"><i class="fa fa-edit" title="تعديل"></i></button>
                                        </div>
                                    {{-- @endif --}}
                                </td>
                                <td> {{ $row->age }}</td>
                                <td>{{ date('d-m-Y', strtotime($row->register_date)) }}</td>
                                <td>
                                    @foreach ($row->rounds as $index => $round)
                                        <label for="">{{ $round->course->name ?? '' }} - </label>
                                    @endforeach
                                </td>
                                <td> @if ($row->follow){{ date('d-m-Y', strtotime($row->follow->followup_date)) }}@endif</td>
                                <td>{{ $row->follow->text ?? '' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('uninterested-clients.edit', $row->id) }}"
                                            class="btn btn-default"><i class="fa fa-eye" title="عرض"></i></a>
                                    </div>
                                </td>


                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade dir-rtl" id="edit{{$row->id}}" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title" id="exampleModalLabel">تغيير وعاء المبيعات</h5>
                                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('change_funnel') }}"  method="POST" >
                                            @csrf
                                        <div class="modal-body text-center">
                                            <h3><i class="fa fa-edit text-white"></i></h3>
                                            <div class="form-group">
                                                <input type="hidden" name="student_id" value="{{$row->id}}">
                                                <label for="">وعاء مبيعات</label>
                                                <select name="sale_fannel_id" class="form-control">
                                                    @foreach ($funnels as $funnel)
                                                    <option value="{{$funnel->id}}">{{$funnel->sale_funnel}}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-success">تأكيد</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
    </div>
    <!-- /.row -->


@endsection
