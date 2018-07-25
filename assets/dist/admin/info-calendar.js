    $(function () {

    // init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      displayEventTime: false,
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : ''//'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      events: 'timesheet/getEvents',
      allDay: true,
      editable: false,
      eventClick: function(calEvent,jsEvent,view) {
        // alert('Description: '+ calEvent.desc);
        $('#modalTitle').html(calEvent.title);
        $('#modalBody').html(calEvent.desc);
        $('#modalUsername').html('Username: '+calEvent.user_name);
        // $('#eventUrl').attr('href',event.url);
        $('#calendarModal').modal();
  }
    })
  });
