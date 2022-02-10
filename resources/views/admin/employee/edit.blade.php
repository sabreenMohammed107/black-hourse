@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>




        <form action="{{ route('employee.update', $row->id) }}" method="post" enctype="multipart/form-data">

            @method('PUT')
            @csrf


                <div class="box-body">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الموظف</label>
                            <input type="text" name="emp_name" value="{{$row->emp_name}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">رقم موبايل</label>
                            <input type="tel" name="mobile" value="{{$row->mobile}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> الوظيفة</label>
                            <input type="text" name="job" value="{{$row->job}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الفرع</label>
                            <select class="form-control" name="branch_id">
                                @foreach($branches as $type)
                                <option value="{{$type->id}}" {{ $row->branch_id == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">الراتب</label>
                            <input type="number" name="salary" value="{{$row->salary}}" class="form-control">
                        </div>
                    </div>



                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">تاريخ التعيين </label>
                            <input type="date" name="hire_date" value="{{date('Y-m-d', strtotime($row->hire_date))}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control" name="notes">{{$row->notes}}</textarea>
                        </div>
                    </div>

                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('employee.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection



