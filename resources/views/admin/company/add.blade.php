@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>





        <form action="{{route('company.store')}}"  method="post" enctype="multipart/form-data">
            @csrf

                <div class="box-body">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">اسم الشركة</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">هواتف الشركة</label>
                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">عنوان الشركة</label>
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">لوجو الشركة</label>
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="customFile">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="checkbox">
                              <label>
                                {{ __('نشط') }}
                                <input type="checkbox" checked  id="newTitle" name="active"  value="1"/>

                              </label>
                            </div>

                    </div>
                    </div>
                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('company.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection



