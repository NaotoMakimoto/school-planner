// calendar.js
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin],
    initialView: 'dayGridMonth',
    fixedWeekCount: false, // これを false に設定すると、月によって4週間または5週間が動的に表示されます
    events: diaryEvents.map(function(event) {
      var imageUrl = 'image/face_img' + event.mood + '.png';
      return {
        start: event.date,
        imageUrl: imageUrl,
        customDate: event.date
      };
    }),
    eventContent: function(arg) {
        var element = document.createElement('div');
        var imageUrl = arg.event.extendedProps.imageUrl;
        if (imageUrl) {
          element.innerHTML = `<img src="${imageUrl}" class="fc-event-image" />`;
        }
        return { domNodes: [element] };
      },

    eventClick: function(info) {
      var date = info.event.start;
      date.setHours(0, 0, 0, 0);
      var formattedDate = [
        date.getFullYear(),
        ('0' + (date.getMonth() + 1)).slice(-2),
        ('0' + date.getDate()).slice(-2)
      ].join('-');
    
      var url = '/home?date=' + formattedDate;
      window.location.href = url;
    },
    
  customButtons: {
      myTodayButton: {
          text: 'today',
          click: function() {
              var today = new Date();
              var formattedDate = today.toISOString().substring(0, 10);
              window.location.href = '/home?date=' + formattedDate;
          }
      }
  },

  headerToolbar: {
      right: 'myTodayButton prev,next',
  },

      
  });

  calendar.render();
});


