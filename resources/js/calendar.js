// calendar.js
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      plugins: [dayGridPlugin],
      initialView: 'dayGridMonth',
      events: diaryEvents.map(function(event) {
        // mood値に応じた画像URLを設定
        var imageUrl =   'image/face_img' + event.mood + '.png';
        return {
          start: event.date,
          imageUrl: imageUrl
        };
      }),
      eventContent: function(arg) {
          var element = document.createElement('div');
          var imageUrl = arg.event.extendedProps.imageUrl;
          if (imageUrl) {
            element.innerHTML = `<img src="${imageUrl}" class="fc-event-image" />`;
          }
          return { domNodes: [element] };
        }
    });
  
    calendar.render();
});

