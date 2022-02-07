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
                            <select class="form-control select2 " name="branch_id" id="c2" >
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
                            <select class=" select2 dynamic form-control" name="course_id" id="course_id">
                                <option value=""> إختر</option>
                                @foreach ($courses as $type )
                                <option value="{{$type->id}}"> {{$type->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">رقم المجموعة</label>
                            <select class=" select2 round form-control" name="round_id" id="round_id" >
                                @foreach ($rounds as $type )
                                <option value="{{$type->id}}"> {{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الطالب</label>
                            <select class=" select2 form-control" name="student_id" id="student_id" >
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
                            <input type="number" name="total_required_fees" class="form-control" id="total_required_fees" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">المبلغ المدفوع </label>
                            <input type="number" name="total_paid_before" oninput="myFunction()" class="form-control" id="total_paid_before" >
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">المبلغ المتبقى </label>
                            <input type="number" name="total_fees_new" class="form-control" id="total_fees_new" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">الخزنة </label>
                            <select class=" select2 form-control" name="cashbox_id" id="cashbox_id" >
                                @foreach ($cashboxes as $type )
                                <option value="{{$type->id}}"> {{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control" name="notes"></textarea>
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
   function myFunction() {
    var total_required_fees = $("#total_required_fees").val();
    var total_paid_before = $("#total_paid_before").val();
    $('#total_fees_new').val((parseFloat(total_required_fees) - parseFloat(total_paid_before)).toFixed(3));
}
    $(function () {
        //Initialize Select2 Elements
        $('#c1').select2()
        $('#c2').select2()
        $('#c3').select2()
        $('#round_id').select2()
        $('#student_id').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
//branch
 $('.dynamic').change(function() {


var value = $(this).val();
// var course=$('#course_id option:selected').val()
$.ajax({
    url: "{{ route('dynamicCourse.fetch') }}",
    method: "get",
    data: {
        value: value,
        // course:course
    },
    success: function(result) {
        $('#round_id').html(result);

        $('#round_id').select2();
    }

})

});
//course
$('.dynamic').change(function() {


var value = $(this).val();
// var course=$('#course_id option:selected').val()
$.ajax({
    url: "{{ route('dynamicCourse.fetch') }}",
    method: "get",
    data: {
        value: value,
        // course:course
    },
    success: function(result) {
        $('#round_id').html(result);
        $('#round_id').select2();
    }

})

});

//round
$('.round').change(function() {


var value = $(this).val();
// var course=$('#course_id option:selected').val()
$.ajax({
    url: "{{ route('dynamicRound.fetch') }}",
    method: "get",
    data: {
        value: value,
        // course:course
    },
    success: function(data) {
        var result = $.parseJSON(data);
        $('#student_id').html(result[0]);
        $('#student_id').select2();
        $('#total_required_fees').val(result[1]);
    }

})

});



    })

    //branch select

</script>
@endsection



