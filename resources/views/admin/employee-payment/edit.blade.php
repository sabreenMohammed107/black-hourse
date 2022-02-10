@extends('layout.web')

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminassets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('adminassets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>


            <form action="{{ route('employee-payment.update', $row->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="box-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">اسم الموظف</label>
                                <select class=" select2 form-control employee" name="employee_id" id="employee_id" >
                                    @foreach ($employees as $type )
                                    <option value="{{$type->id}}" {{ $row->employee_id == $type->id ? 'selected' : '' }} > {{$type->emp_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">تاريخ</label>
                                <input type="date" value="{{date('Y-m-d', strtotime($row->start_balance_date))}}" name="start_balance_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">الفرع</label>
                                <select class="form-control select2 " name="branch_id" id="c2" >
                                    @foreach ($branches as $type )
                                    <option value="{{$type->id}}" {{ $row->cashbox->branch_id == $type->id ? 'selected' : '' }} > {{$type->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">الخزنة </label>
                                <select class=" select2 form-control" name="cashbox_id" id="cashbox_id" >
                                    @foreach ($cashboxes as $type )
                                    <option value="{{$type->id}}" {{ $row->cashbox_id == $type->id ? 'selected' : '' }}> {{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">المبلغ المطلوب </label>
                                <input type="number" value="{{$row->employee->salary ?? ''}}" class="form-control" id="salary">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">المبلغ المدفوع </label>
                                <input type="number"name="amount" class="form-control" id="">
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="">ملاحظات</label>
                                <input type="text" name="notes" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('employee-payment.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection
@section('scripts')
<!-- Select2 -->
<script src="{{ asset('adminassets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>

    $(function () {
        //Initialize Select2 Elements
        $('#cashbox_id').select2()
        $('#branch_id').select2()
        $('#employee_id').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
               //round
$('.employee').change(function() {


var value = $(this).val();
// var course=$('#course_id option:selected').val()
$.ajax({
    url: "{{ route('employee-paymentdynamicSalary.fetch') }}",
    method: "get",
    data: {
        value: value,
        // course:course
    },
    success: function(data) {

        var result = $.parseJSON(data);

        $('#salary').val(result[0]);
    }

})

});
    });
    </script>
@endsection



