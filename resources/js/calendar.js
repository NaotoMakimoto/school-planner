// calendar.js
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin],
    initialView: 'dayGridMonth',
    events: [
      { start: '2024-04-01', imageUrl: 'image/face_img1.png' },
      { start: '2024-04-02', imageUrl: 'image/face_img2.png' },
      { start: '2024-04-03', imageUrl: 'image/face_img3.png' },
      { start: '2024-04-04', imageUrl: 'image/face_img4.png' },
      { start: '2024-04-05', imageUrl: 'image/face_img5.png' },
      // ... その他のイベント
    ],
    eventContent: function(arg) {
        var element = document.createElement('div');
        var imageUrl = arg.event.extendedProps.imageUrl;
        if (imageUrl) {
          // `class="fc-event-image"` を img タグに適用します
          element.innerHTML = `<img src="${imageUrl}" class="fc-event-image" />`;
        } else {
          element.innerText = arg.event.title;
        }
        return { domNodes: [element] };
      }
  });

  calendar.render();
});
