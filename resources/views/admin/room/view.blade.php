@extends('layout.web')
@section('style')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{ asset('adminassets/plugins/fullcalendar/main.css')}}">
@endsection

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">تعديل</h3>
        </div>





        <form action="{{route('room.update',$row->id)}}"  method="post" enctype="multipart/form-data">

            @method('PUT')
              @csrf

                <div class="box-body">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الفرع</label>
                            <select name="branch_id" class="form-control" id="">

                                @foreach($branches as $type)
                                <option value="{{$type->id}}" {{ $row->branch_id == $type->id ? 'selected' : '' }} >{{$type->name}}</option>
                                @endforeach
                              </select>                          </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> رقم القاعة</label>
                            <input type="text" name="room_no" value="{{$row->room_no}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> السعة</label>
                            <input type="number" name="capacity" value="{{$row->capacity}}" class="form-control" id="">
                        </div>
                    </div>


                    <h5> جدول مواعيد حجز القاعة</h5><br />
                    <div class="row">
                        <div class="col-md-3" style="display:none">
                            <div class="sticky-top mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">الكورسات / الدورات</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- the events -->
                                        <div id="external-events">
                                            <div class="external-event bg-success">كورس فاشون</div>
                                            <div class="external-event bg-warning">كورس برمجة</div>
                                            <div class="external-event bg-info">كورس جرافيك</div>
                                            <div class="external-event bg-primary">كورس ديزاين</div>
                                            <div class="external-event bg-danger">كورس تنمية</div>
                                            <div class="checkbox">
                                                <label for="drop-remove">
                                                    <input type="checkbox" id="drop-remove">
                                                    حذف بعد الإضافة
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">حجز قاعة</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                            <ul class="fc-color-picker" id="color-chooser">
                                                <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- /btn-group -->
                                        <div class="input-group">
                                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                                            <div class="input-group-append">
                                                <button id="add-new-event" type="button" class="btn btn-primary">إضافة</button>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-body p-0">
                                    <!-- THE CALENDAR -->
                                    <div id='calendar'></div>
                                    <!-- /.modal -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            <!-- /.card-body -->
            <div class="box-footer">
                {{-- <button type="submit" class="btn btn-primary">حفظ</button> --}}
                <a href="{{route('room.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection
@section('scripts')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('adminassets/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('adminassets/plugins/fullcalendar/main.js')}}"></script>
<script>
	$(function () {

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

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        right  : 'prev,next today',
        center: 'title',
        left : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      events: [
        {
          id			 : 10,
          title          : 'محجوز تدريب',
          start          : new Date(y, m, d - 9),
          end            : new Date(y, m, d - 9),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954', //red
          allDay         : true
        },
		{
          title          : 'ندوة تنمية بشرية',
          start          : new Date(y, m,1),
          end            : new Date(y, m,1),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12', //yellow
          allDay         : true
		},
		{
          title          : 'كورس ديزاين',
          start          : new Date(y, m, 10, 18,0),
          end            : new Date(y, m, 10, 21,0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'كورس ويب',
          start          : new Date(y, m, d - 5, 10, 30),
          end            : new Date(y, m, d - 5, 12, 30),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
		{
          title          : 'كورس برمجة',
          start          : new Date(y, m , d , 12, 0),
          end            : new Date(y, m , d , 14, 0),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'كورس فاشون',
          start          : new Date(y, m, d, 9, 0),
          end            : new Date(y, m , d , 11, 0),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'كورس ديزاين',
          start          : new Date(y, m, d, 15, 0),
          end            : new Date(y, m, d, 18, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'كورس برمجة',
          start          : new Date(y, m,19, 19, 0),
          end            : new Date(y, m,19, 21, 0),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 23),
          end            : new Date(y, m, 23),
          allDay         : true,
          url            : 'https://www.google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
	})

	</script>
@endsection



