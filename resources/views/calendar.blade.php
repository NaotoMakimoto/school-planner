{{-- @extends('layouts.app_original')
@section('content') --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel × FullCalendar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/calendar.js'])
    <script>
       var diaryEvents = @json($diaries->map(function ($diary) {
            // 'date' フィールドが Carbon インスタンスであることを確認
            $date = $diary->date instanceof \Carbon\Carbon ? $diary->date->format('Y-m-d') : $diary->date;

            return [
                'date' => $date,
                'mood' => $diary->mood,
                // 'imageUrl' など他のプロパティがあればここに追加
            ];
        }));

    </script>
</head>
<body>
    <div id="app">
        <div class="m-auto w-50 m-5 p-5">
            <div id='calendar'></div>
        </div>
    </div>

    
</body>
{{-- 
@endsection --}}
</html>
