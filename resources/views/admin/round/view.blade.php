@extends('layout.web')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminassets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminassets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">
            <div class="box box-primary px-5">
                <div class="box-header">
                    <h3 class="box-title"> بيانات المجموعة</h3>
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
                                                    اساسية</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-2-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-2" role="tab" aria-controls="custom-tabs-one-2"
                                                    aria-selected="false">الطلاب </a>
                                            </li>



                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade in active" id="custom-tabs-one-1" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-1-tab">
                                                <div class="card card-primary">
                                                    <!-- form start -->
                                                    <form action="{{ route('start-round') }}" method="post"
                                                        enctype="multipart/form-data">


                                                        @csrf
                                                        <input type="hidden" name="round_id" value="{{ $row->id }}">
                                                        <div class="box-body">

                                                            <div class="col-sm-6 mb-2">
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <button type="submit" class="btn btn-danger">بدا
                                                                    المجموعه</button>

                                                                <input type="text" class="form-control" value="فى الحجز">

                                                            </div>
                                                            <hr>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> رقم المجموعة</label>
                                                                    <input type="text" name="round_no" value="{{ $row->round_no }}" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">  عدد الساعات</label>
                                                                    <input type="text"  readonly value="{{ $row->course->course_hours }}" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">اسم الفرع</label>
                                                                    <select name="branch_id" class="form-control" id="">

                                                                        @foreach ($branches as $type)
                                                                            <option value="{{ $type->id }}"
                                                                                {{ $row->branch_id == $type->id ? 'selected' : '' }}>
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> إيجار القاعة اليومي</label>
                                                                    <select name="room_id" class="form-control" id="">

                                                                        @foreach ($rooms as $type)
                                                                            <option value="{{ $type->id }}"
                                                                                {{ $row->room_id == $type->id ? 'selected' : '' }}>
                                                                                {{ $type->room_no }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> اسم الدوره</label>
                                                                    <select name="course_id" class="form-control" id="">

                                                                        @foreach ($courses as $type)
                                                                            <option value="{{ $type->id }}"
                                                                                {{ $row->course_id == $type->id ? 'selected' : '' }}>
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ البداية</label>
                                                                    <input type="date" name="start_date"
                                                                        value="{{ date('Y-m-d', strtotime($row->start_date)) }}"
                                                                        class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ النهاية</label>
                                                                    <input type="date" readonly name="end_date"
                                                                        value="{{ date('Y-m-d', strtotime($row->end_date)) }}"
                                                                        class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> التكلفة</label>
                                                                    <input type="text" name="fees"
                                                                        value="{{ $row->fees }}" class="form-control"
                                                                        id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> الخصم</label>
                                                                    <input type="text" name="discount_per"
                                                                        value="{{ $row->discount_per }}"
                                                                        class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> إيجار القاعة</label>
                                                                    <input type="text" disabled name="rent_room_fees"
                                                                        value="{{ $row->rent_room_fees }}"
                                                                        class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> مبلغ الشهادة</label>
                                                                    <input type="text" disabled name="certificate_fees"
                                                                        value="{{ $row->certificate_fees }}"
                                                                        class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for=""> اسم المدرب</label>
                                                                    <select name="trainer_id" class="form-control" id="">

                                                                        @foreach ($trainers as $type)
                                                                            <option value="{{ $type->id }}"
                                                                                {{ $row->trainer_id == $type->id ? 'selected' : '' }}>
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-12">


                                                                <div class="form-group">

                                                                    <select name="round_days[]" multiple
                                                                        class="form-control" id="selecteddays">

                                                                        {{-- <option disabled value=""> أيام المجموعات </option> --}}
                                                                        @foreach ($roundDays as $index => $days)
                                                                            <option selected
                                                                                value="{{ $days->day_id }},{{ $days->time }},{{ $days->to }}"
                                                                                ondblclick="removeOpt({{ $index + 1 }})">
                                                                                Day : {{ $days->day->name ?? '' }}, At :
                                                                                {{ $days->from }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>

                                                            </div>








                                                            <div class="w-100 my-1" id="added">









                                                            </div>

                                                            <!--  /Add Round days and times -->

                                                        </div>

                                                        <!-- /.card-body -->
                                                        <div class="box-footer">
                                                            {{-- <button type="submit" class="btn btn-primary">حفظ</button> --}}
                                                            <a href="{{ route('round.index') }}"
                                                                class="btn btn-danger">إلغاء</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                @include('admin.round.students')
                                                <hr />


                                            </div>




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
            <script src="{{ asset('adminassets/plugins/select2/js/select2.full.min.js') }}"></script>
            <script>
                function myFunction(index) {
                    var total_required_fees = $("#total_required_fees" + index).val();
                    var total_fees_new = Number($("#total_fees_new" + index).val()) + Number($("#total_paid_before" + index).val());

                    $('#remain' + index).val(total_required_fees - total_fees_new);
                }
                $(function() {
                    //Initialize Select2 Elements

                    $('#student_id1').select2()
                    //Initialize Select2 Elements
                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    })
                });
            </script>
        @endsection
