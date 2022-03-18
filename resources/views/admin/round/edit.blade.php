@extends('layout.web')


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">تعديل</h3>
                </div>





                <form action="{{ route('round.update', $row->id) }}" method="post" enctype="multipart/form-data">

                    @method('PUT')
                    @csrf

                    <div class="box-body">
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
                                <select name="branch_id" class="form-control dynamic" id="branch_id">

                                    @foreach ($branches as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $row->branch_id == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""> رقم القاعة</label>
                                <select name="room_id" class="form-control" id="room_id">

                                    @foreach ($rooms as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $row->room_id == $type->id ? 'selected' : '' }}>{{ $type->room_no }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""> اسم الدوره</label>
                                <select name="course_id" class="form-control course" id="course_id">

                                    @foreach ($courses as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $row->course_id == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">تاريخ البداية</label>
                                <input type="date" name="start_date"
                                    value="{{ date('Y-m-d', strtotime($row->start_date)) }}" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">تاريخ النهاية</label>
                                <input type="date" readonly name="end_date" @if($row->end_date) value="{{ date('Y-m-d', strtotime($row->end_date)) }}" @endif
                                    class="form-control" id="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""> التكلفة</label>
                                <input type="text" name="fees" value="{{ $row->fees }}" class="form-control" id="fees">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""> الخصم</label>
                                <input type="text" name="discount_per" value="{{ $row->discount_per }}"
                                    class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""> إيجار القاعة اليومي</label>
                                <input type="text" name="rent_room_fees" value="{{ $row->rent_room_fees }}"
                                    class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""> مبلغ الشهادة</label>
                                <input type="text" name="certificate_fees" value="{{ $row->certificate_fees }}"
                                    class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""> اسم المدرب</label>
                                <select name="trainer_id" class="form-control" id="trainer_id">

                                    @foreach ($trainers as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $row->trainer_id == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
 <!--  Add Round days and times -->

 <div id="roundDT" >


    {{-- <div class="form-group"> --}}


        <div class="col-md-12">
        <div class="form-group">
            <label for="note">أختر ايام المجموعه</label>
            <select name="day_id" disabled class="form-control" id="Days">

                 @foreach ($days as $day)

                    <option value="{{ $day->id }}"> {{ $day->name }} </option>

                @endforeach
                {{-- <option  value="1"> السبت </option>
                <option value="2"> الاحد </option>
                <option value="3"> الاثنين </option>
                <option value="4"> الثلاثاء </option>
                <option value="5"> الاربعاء </option>
                <option value="6"> الخميس </option>
                <option value="7"> الجمعه </option> --}}
            </select>



        </div>

        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label for="note">من الساعة</label>

                <input type="time" disabled class="form-control d-block" id="Daytime">


            </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">

                    <label for="note">  الى الساعة</label>
                    <input type="time" disabled class="form-control d-block" id="to">

                </div>

                </div>
            </div>
        <div class="form-group">

            <button type="button" onclick="addRoundDay()" disabled class="btn btn-dark"
                style="margin:0px auto;">اضافة موعد </button>

        </div>

        {{-- <h6>*انقر مرتين لحذف الموعد*</h6> --}}



        <div class="form-group">

            <select name="round_days[]" multiple class="form-control" id="selecteddays">

                {{-- <option disabled value=""> أيام المجموعات </option> --}}
                @foreach ($roundDays as $index=> $days)

                <option selected value="{{$days->day_id}},{{$days->time}},{{$days->to}}" ondblclick="removeOpt({{$index}})" >Day : {{$days->day->name ?? ''}}, At : {{$days->from}}</option>
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
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="{{ route('round.index') }}" class="btn btn-danger">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
<script src="{{ asset('adminassets/Datasave.js') }}"></script>
<script>
    $(function () {
    //branch
 $('.dynamic').change(function() {


var value = $(this).val();
$.ajax({
    url: "{{ route('dynamicRoundRoom.fetch') }}",
    method: "get",
    data: {
        value: value,
        // course:course
    },
    success: function(result) {
        $('#room_id').html(result);

    }

})

});

//course
$('.course').change(function() {


var value = $(this).val();
$.ajax({
    url: "{{ route('dynamicRoundCourse.fetch') }}",
    method: "get",
    data: {
        value: value,
        // course:course
    },
    success: function(data) {
        var result = $.parseJSON(data);
        $('#trainer_id').html(result[0]);
        $('#fees').val(result[1]);
        $('#hours').val(result[2]);

    }

})

});

});

var RoundDays = [];

var Days = [];

function addRoundDay() {



  var time = $('#Daytime').val();

  var to = $('#to').val();

  var Day = $('#Days').val();

  var DayText = $("#Days option:selected").text();

  var RoundDay = {

    Day : Day,

    Time : time,

    DayText : DayText,

    To : to

  }

  RoundDays.push(RoundDay);

  Days.push(Day);



  $('#selecteddays').empty();

  $.each(RoundDays,function(index,elem){

    // var elem = JSON.stringify(elem);

    var option = '<option selected value="'+elem.Day+','+elem.Time+','+elem.To+'" ondblclick="removeOpt('+ index + ')">Day : (' + elem.DayText  + '), At : (' + elem.Time + ')</option>'

    // $('#selecteddays').append(option);
     $('#selecteddays').append(option);

  })

//   console.table(RoundDays);

//   console.table(Days);

}
function removeOpt(index) {

    alert(index);

$('#selecteddays option')[index].remove();
// console.log(RoundDays);
  RoundDays.splice(index,1);

//  $('#selecteddays').empty();

$.each(RoundDays,function(index,elem){

//    var elem = JSON.stringify(elem);

  var option = '<option value="" ondblclick="removeOpt('+ index + ')">Day : (' + elem.DayText  + '), At : (' + elem.Time + ')</option>'

  $('#selecteddays').append(option);

})

// console.table(RoundDays);

}
</script>
@endsection

