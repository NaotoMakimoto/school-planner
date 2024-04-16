<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="top_content">
        <div>{{ $today }}</div>
        <div>
            <div>
                <h1>宿題</h1>
                @foreach ($tasks as $task)
                <p>{{ $task->assignments }}</p>
                @endforeach
            </div>
            <div>
                <h1>持ち物</h1>
                @foreach ($tasks as $task)
                <p>{{ $task->belongings }}</p>
                @endforeach
            </div>
        </div>
    </div>
    <div class="middle_content">
        <table>
            @foreach ($lessons as $lesson)
            <tr>
               
                <th>{{ $lesson->period }}</th>
                <td>{{ $lesson->subject->name }}</td>
                <td>{{ $lesson->content }}</td>
            
                @if($lesson->studentResponse)
                    <td>{{ $lesson->studentResponse->understanding }}</td>
                    <td>{{ $lesson->studentResponse->comment }}</td>
                @endif
            
            </tr>
            @endforeach
        
        </table>
    </div>
    <div class="bottom_content">
        <div>日記</div>
        @if($diary)
        <div>{{ $diary->mood }}</div>
        <div>{{ $diary->diary_content }}</div>
        @endif
    
        <div>{{ $diary->teacherComment->comment }}</div>
    </div>
</body>
</html>
