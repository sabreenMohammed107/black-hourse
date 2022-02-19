@extends('layout.web')

@section('title', 'المجموعات الحالية')
@section('style')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{ asset('adminassets/plugins/fullcalendar/main.css')}}">
<style>
.fc table {
    border-collapse: collapse;
    border-spacing: 0;
    font-size: 1em;
    color: #fff !important;
}
.table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6 !important;
}
.fc-v-event .fc-event-main-frame {

    text-align: right !important;
}
</style>

@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"> عرض بيانات الجدول اليومى
            </h3>
<!-- form start -->
<form role="form" action="{{route('daily-schedule.store')}}"  method="post" enctype="multipart/form-data">
    @csrf

    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">الفرع</label>
                    <select name="branch_id" class="form-control dynamic" id="branch_id">
                        <option value="">إختر ...</option>
                        @foreach($branches as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">القاعة</label>
                    <select name="room_id" class="form-control" id="room_id">

                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group" style="margin-top: 20px;">
            <button type="submit" class="btn btn-info btn-lg pull-left "> بحث </button>
        </div>
    </div>
        </div>
    </div>
</form>
        </div><!-- /.box-header -->
        <div class="box-body">
{{-- calender --}}
<div id='calendar'>

</div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
@section('scripts')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('adminassets/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('adminassets/plugins/fullcalendar/main.js')}}"></script>
<script>
	$(function () {
    //rooms
    $('.dynamic').change(function() {


var value = $(this).val();
alert(value)
$.ajax({
    url: "{{ route('branch-room.fetch') }}",
    method: "get",
    data: {
        value: value,
    },
    success: function(result) {
        $('#room_id').html(result);
    }

})

});
  /* initialize the external events
     -----------------------------------------------------------------*/
     function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });
    // initialize the external events
    // -----------------------------------------------------------------

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        right  : 'prev,next today',
        center: 'title',
        left : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      events:{!! $data !!}

    ,

      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!

    });

    calendar.render();
    // $('#calendar').fullCalendar()



    });
	</script>
@endsection




