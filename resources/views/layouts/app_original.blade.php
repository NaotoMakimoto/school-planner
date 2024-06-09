<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header_style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
</head>
<body>
    <header class="head">
        {{-- ハンバーガー --}}
        <div class="hamburger" id="hamburger" onclick="hamburgerClose()">
            <span class="bar bar-top"></span>
            <span class="bar bar-middle"></span>
            <span class="bar bar-bottom"></span>
        </div>
        <nav class="nav-menu" id="nav-menu">
            <ul>
              <li>
                <form action="{{ route('calendar.check') }}" method="get">
                    <button type="submit">カレンダー</button>
                </form>
              </li>
              <li><a href="#">menu2</a></li>
              <li><a href="#">menu3</a></li>
              <li><a href="#">menu4</a></li>
              <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>
            </ul>
        </nav>
      
        <p>
            {{ $user->grade }}年{{ $user->class }}組{{ $user->attendance_number }}番 {{ $user->name }}　  
            @if(session('teacherId'))
                @php
                    $teacher = App\Models\User::find(session('teacherId'));
                @endphp
                （<a href="{{ route('studentPage.back') }}">  {{ $teacher->name }}</a>としてログインしています）
            @endif
        </p>
        
    </header>

    @yield('content')

    <footer>

    </footer>
    <script src="js\script.js"></script>
</body>
</html>