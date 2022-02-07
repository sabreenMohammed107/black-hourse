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





        <form action="{{route('invoice.store')}}"  method="post" enctype="multipart/form-data">
            @csrf

                <div class="box-body">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">رقم الفاتورة</label>
                            <input type="text" name="invoice_no" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">نوع الدفع</label>
                            <select class="form-control select2" name="payment_type_id" id="c3" >
                                @foreach ($types as $type )
                                <option value="{{$type->id}}"> {{$type->payment_type}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">الفرع</label>
                            <select class="form-control select2 dynamic" name="branch_id" id="c2" >
                                @foreach ($branches as $type )
                                <option value="{{$type->id}}"> {{$type->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الدورة</label>
                            <select class="form-control select2" name="course_id" id="course_id">
                                @foreach ($courses as $type )
                                <option value="{{$type->id}}"> {{$type->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">رقم المجموعة</label>
                            <select class="form-control select2" name="round_id" id="c4" >
                                @foreach ($rounds as $type )
                                <option value="{{$type->id}}"> {{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الطالب</label>
                            <select class="form-control select2" name="student_id" id="c5" >
                                @foreach ($students as $type )
                                <option value="{{$type->id}}"> {{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">تاريخ الفاتورة</label>
                            <input type="date" name="invoice_date" class="form-control">
                        </div>
                    </div>



                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">المبلغ المطلوب </label>
                            <input type="number" class="form-control" id="" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">المبلغ المدفوع </label>
                            <input type="number" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">المبلغ المتبقى </label>
                            <input type="number" class="form-control" id="" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>
                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('invoice.index')}}" class="btn btn-danger">إلغاء</a>
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
        $('#c1').select2()
        $('#c2').select2()
        $('#c3').select2()
        $('#c4').select2()
        $('#c5').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
//branch
 $('.dynamic').change(function() {


var value = $(this).val();
var course=$('#course_id option:selected').val()
$.ajax({
    url: "{{ route('dynamicBranch.fetch') }}",
    method: "get",
    data: {
        value: value,
        course:course
    },
    success: function(result) {

        $('#course_id').html(result);
    }

})

});

    })

    //branch select

</script>
@endsection



