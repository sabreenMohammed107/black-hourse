@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>





        <form action="{{route('general-students.store')}}"  method="post" enctype="multipart/form-data">
            @csrf

                <div class="box-body">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الطالب</label>
                            <input type="text" name="name" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">رقم موبايل</label>
                            <input type="tel" name="mobile" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">البريد الالكتروني</label>
                            <input type="email" name="email" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الشركة</label>
                            <select class="form-control" name="company_id">
                                @foreach($companies as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">دراسة</label>
                            <input type="text" name="education" class="form-control" >
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">وظيفة</label>
                            <input type="text" name="job" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">المحافظة</label>
                            <select class="form-control" name="city_id">
                                @foreach($cities as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">وعاء مبيعات</label>
                            <select class="form-control" name="sale_fannel_id">
                                @foreach($funnels as $type)
                                <option value="{{$type->id}}">{{$type->sale_funnel}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">السن </label>
                            <input type="number" name="age" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">تاريخ التسجيل </label>
                            <input type="date" name="register_date" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">حالة الطلب</label>
                            <select class="form-control" name="request_status_id">
                                @foreach($status as $type)
                                <option value="{{$type->id}}">{{$type->request_status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('general-students.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection



