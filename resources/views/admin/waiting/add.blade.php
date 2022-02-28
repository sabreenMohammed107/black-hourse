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



<!-- form start -->
<form action="{{route('waiting.store')}}"  method="post" enctype="multipart/form-data">
    @csrf
<div class="box-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>رقم هوية الطالب</label>
                    <select class="form-control select2" name="student_id" id="student_id" style="width: 100%;">
                        <option selected="selected">...</option>
                        @foreach ($allStudents as $all)
                        <option value="{{$all->id}}">{{$all->name}}</option>
                        @endforeach


                    </select>
                </div>
                <!-- /.form-group -->
            </div>
            <div class="col-md-4 mt-2">
                <br />
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#new-student">إضافة طالب
                    جديد</a>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-sm-4">
                <div class="form-group">
                    <label for="">رقم الفاتورة</label>
                    <input type="text" name="invoice_no" value="{{old('invoice_no')}}" class="form-control" id="">
                </div>
            </div> --}}

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">رقم موبايل</label>
                    <input type="tel" name="mobile2" value="{{old('mobile2')}}" class="form-control" id="">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">الفرع</label>
                    <select class="form-control select2 " name="branch_id" id="branch_id" >
                        @foreach ($branches as $type )
                        <option value="{{$type->id}}"> {{$type->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
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
                    <label for="">تاريخ الحجز</label>
                    <input type="date" name="invoice_date" value="{{old('invoice_date')}}" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">المبلغ المطلوب </label>
                    <input type="number" name="total_required_fees" onchange="myFunction()" value="{{old('total_required_fees')}}" class="form-control" id="total_required_fees">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">المبلغ المدفوع </label>
                    <input type="number" name="total_fees_new" onchange="myFunction()" value="{{old('total_fees_new')}}" class="form-control" id="total_fees_new">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">المبلغ المتبقى </label>
                    <input type="number" name="remian" value="{{old('remian')}}" readonly class="form-control" id="remian">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">المواعيد المناسبة</label>
                    <input type="text" name="contact_times" value="{{old('contact_times')}}" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">التاريخ المناسب للتواصل </label>
                    <input type="date" name="contact_date" value="{{date('d-m-Y', strtotime(old('contact_date')))}}" class="form-control" id="">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">ملاحظات</label>
                    <input type="text" name="notes" value="{{old('notes')}}" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('waiting.index')}}" class="btn btn-danger">إلغاء</a>
    </div>
</form>
</div>
<!-- /.card -->
            </div>
    </div>

    <!-- Add New Student Modal -->
<div class="modal fade dir-rtl" id="new-student" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة طالب جديد</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('saveStudent') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="round_id" value="{{$roundSS->id}}"> --}}
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit "></i></h3>
                <h4> إضافة طالب جديد </h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">إسم الطالب</label>
                            <input type="text" name="name" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">موبايل</label>
                            <input type="tel" name="mobile" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ايميل</label>
                            <input type="email" name="email" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">دراسة </label>
                            <input type="text" name="education" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">وظيفة</label>
                            <input type="text" name="job" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ملاحظات </label>
                            <input type="text" name="note" class="form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-success">حفظ</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Select2 -->
<script src="{{ asset('adminassets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
   function myFunction() {
    var total_required_fees = $("#total_required_fees").val();
    var total_fees_new = $("#total_fees_new").val();
    $('#remian').val((parseFloat(total_required_fees) - parseFloat(total_fees_new)).toFixed(0));
}
$(function () {
        //Initialize Select2 Elements

        $('#branch_id').select2()
        $('#course_id').select2()
        $('#student_id').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>
@endsection



