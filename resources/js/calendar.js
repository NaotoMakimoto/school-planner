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
        // イベントの開始日を取得し、ローカルの日付に変換
        var date = info.event.start;
        date.setHours(0, 0, 0, 0); // 日付だけが欲しいので、時間情報をクリアする
      
        // ローカルの日付を 'YYYY-MM-DD' フォーマットに変換
        var formattedDate = [
          date.getFullYear(),
          ('0' + (date.getMonth() + 1)).slice(-2),
          ('0' + date.getDate()).slice(-2)
        ].join('-');
      
        // homeルートにクエリパラメータとして日付を渡す
        var url = '/home?date=' + formattedDate;
        window.location.href = url;
      },
      
    customButtons: {
        myTodayButton: {
            text: 'today', // 表示するテキスト
            click: function() {
                var today = new Date();
                var formattedDate = today.toISOString().substring(0, 10);
                window.location.href = '/home?date=' + formattedDate; // 今日の日付をクエリパラメータとして設定
            }
        }
    },

    headerToolbar: {
        right: 'myTodayButton prev,next', // カスタムTodayボタンをヘッダーツールバーに追加
    },

        
    });
  
    calendar.render();
});

