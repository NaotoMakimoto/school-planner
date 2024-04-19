<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel × FullCalendar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/calendar.js'])
</head>
<body>
    <div id="app">
        <div class="m-auto w-50 m-5 p-5">
            <div id='calendar'></div>
        </div>
    </div>

    
</body>
</html>
