<!DOCTYPE html>
<html>
<head>
    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body>

<div class="container">
    <h1>Laravel FullCalender Tutorial Example - ItSolutionStuff.com</h1>
    <div id='calendar'></div>
</div>
<!-- fullCalendar 2.2.5 -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

{{-- <script src="{{ asset('adminassets/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('adminassets/plugins/fullcalendar/main.js')}}"></script> --}}
<script>
	// $(function () {
        $(document).ready(function () {

   var SITEURL = "{{ url('/room/1/') }}";

   $.ajaxSetup({
    headerToolbar: {
        right  : 'prev,next today',
        center: 'title',
        left : 'dayGridMonth,timeGridWeek,timeGridDay'
      }
   });

   var calendar = $('#calendar').fullCalendar({
                       editable: true,
                       events: SITEURL + "/full-calender",
                       displayEventTime: false,
                       editable: true,
                       eventRender: function (event, element, view) {
                           if (event.allDay === 'true') {
                                   event.allDay = true;
                           } else {
                                   event.allDay = false;
                           }
                       },
                       selectable: true,
                       selectHelper: true,
                    });
                });

	</script>
    </body>
</html>



