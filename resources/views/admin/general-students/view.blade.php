@extends('layout.web')
@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminassets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('adminassets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('title', ' المجموعات')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">
            <div class="box box-primary px-5">
                <div class="box-header">
                    <h3 class="box-title"> بيانات المجموعة - {{$row->name}}</h3>
                </div>







                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class=" card-info card-tabs">
                                    <div class="box-header p-0 pt-1 bg-white">
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                            <li class="nav-item active">
                                                <a class="nav-link text-dark " id="custom-tabs-one-1-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-1" role="tab" aria-controls="custom-tabs-one-1"
                                                    aria-selected="true">بيانات
                                                    اساسية </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-2-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-2" role="tab" aria-controls="custom-tabs-one-2"
                                                    aria-selected="false">الدورات المسجل بها </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-7-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-7" role="tab" aria-controls="custom-tabs-one-7"
                                                    aria-selected="false">الدبلومات   </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-3-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-3" role="tab" aria-controls="custom-tabs-one-3"
                                                    aria-selected="false">مالية </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-4-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-4" role="tab" aria-controls="custom-tabs-one-4"
                                                    aria-selected="false">إستثناءات </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-5-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-5" role="tab" aria-controls="custom-tabs-one-5"
                                                    aria-selected="false">الحضور </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-8-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-8" role="tab" aria-controls="custom-tabs-one-8"
                                                    aria-selected="false"> خدمة العملاء </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-6-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-6" role="tab" aria-controls="custom-tabs-one-6"
                                                    aria-selected="false">متابعة المركز </a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade in active" id="custom-tabs-one-1" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-1-tab">
                                                <div class="card card-primary">
                                                    <!-- form start -->
                                                    <form action="{{route('general-students.update',$row->id)}}"  method="post" enctype="multipart/form-data">

                                                        @method('PUT')
                                                          @csrf


                                                        <div class="box-body">

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">اسم الطالب</label>
                                                                    <input type="text" readonly name="name" value="{{$row->name}}" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">رقم موبايل</label>
                                                                    <input type="tel" readonly  name="mobile" value="{{$row->mobile}}" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">البريد الالكتروني</label>
                                                                    <input type="email" readonly name="email" value="{{$row->email}}" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">اسم الشركة</label>
                                                                    <select class="form-control"   disabled name="company_id">
                                                                        @foreach($companies as $type)
                                                                        <option value="{{$type->id}}"  {{ $row->company_id == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">دراسة</label>
                                                                    <input type="text" readonly name="education" value="{{$row->education}}" class="form-control" >
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">وظيفة</label>
                                                                    <input type="text" readonly name="job" value="{{$row->job}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">المحافظة</label>
                                                                    <select class="form-control" disabled name="city_id">
                                                                        @foreach($cities as $type)
                                                                        <option value="{{$type->id}}" {{ $row->city_id == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                                        @endforeach


                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">وعاء مبيعات</label>
                                                                    <select class="form-control" disabled name="sale_fannel_id">
                                                                        @foreach($funnels as $type)
                                                                        <option value="{{$type->id}}" {{ $row->sale_fannel_id == $type->id ? 'selected' : '' }}>{{$type->sale_funnel}}</option>
                                                                        @endforeach


                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">السن </label>
                                                                    <input type="number" readonly name="age" value="{{$row->age}}" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ التسجيل </label>
                                                                    <input type="date" readonly name="register_date" value="{{ date('Y-m-d', strtotime($row->register_date)) }}" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">حالة الطلب</label>
                                                                    <select class="form-control" disabled name="request_status_id">
                                                                        @foreach($status as $type)
                                                                        <option value="{{$type->id}}" {{ $row->request_status_id == $type->id ? 'selected' : '' }} >{{$type->request_status}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    <!-- /.card-body -->
                                                    <div class="box-footer">
                                                        {{-- <button type="submit" class="btn btn-primary">حفظ</button> --}}
                                                        <a href="{{route('general-students.index')}}" class="btn btn-danger">إلغاء</a>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                @include('admin.general-students.rounds')
                                                <hr />


                                            </div>
  {{-- الدبلومة --}}
  <div class="tab-pane fade" id="custom-tabs-one-7" role="tabpanel"
  aria-labelledby="custom-tabs-one-7-tab">
  @include('admin.general-students.deploma')
  <hr />


</div>
                                            {{-- مالية --}}
                                            <div class="tab-pane fade" id="custom-tabs-one-3" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-3-tab">
                                                @include('admin.general-students.finance')
                                                <hr />


                                            </div>
                                            {{-- استثناءات --}}
                                            <div class="tab-pane fade" id="custom-tabs-one-4" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-4-tab">
                                                @include('admin.general-students.exeptions')
                                                <hr />


                                            </div>
                                            {{-- حضور --}}
                                            <div class="tab-pane fade" id="custom-tabs-one-5" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-5-tab">
                                                @include('admin.general-students.attendace')
                                                <hr />


                                            </div>
                                            {{-- خدمة العملاء --}}
                                            <div class="tab-pane fade" id="custom-tabs-one-8" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-8-tab">
                                            @include('admin.general-students.callcenter')
                                            <hr />
                                            </div>
                                            {{-- متابعة المركز --}}
                                            <div class="tab-pane fade" id="custom-tabs-one-6" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-6-tab">
                                                @include('admin.general-students.followup')
                                                <hr />


                                            </div>





                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->

        @endsection

        @section('scripts')
<!-- Select2 -->
<script src="{{ asset('adminassets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    })
</script>
        @endsection
