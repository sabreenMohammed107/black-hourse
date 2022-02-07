@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>





        <form action="{{route('cashbox.store')}}"  method="post" enctype="multipart/form-data">
            @csrf

                <div class="box-body">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label> اسم الخزينة</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label> اسم الفرع</label>
                            <select name="branch_id" class="form-control" id="">

                                @foreach($branches as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label> تاريخ الرصيد الإفتتاحى</label>
                            <input type="date" name="start_balance_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>مبلغ الرصيد الإفتتاحى</label>
                            <input type="number" name="start_blalnc_amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control " name="notes">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('cashbox.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection



