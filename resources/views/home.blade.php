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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <thead>
                <tr>
                    <th>Period</th>
                    <th>Subject</th>
                    <th>Content</th>
                    <th>Understanding</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 6; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        @php
                            $lesson = $lessons->firstWhere('period', $i);
                        @endphp
                        <td>{{ $lesson->subject->name ?? '' }}</td>
                        <td>{{ $lesson->content ?? '' }}</td>
                        <td>{{ $lesson->studentResponse->understanding ?? '' }}</td>
                        <td>{{ $lesson->studentResponse->comment ?? '' }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    
    
    
    <div class="bottom_content">
        <div>日記</div>
        @if($diary)
        <div>{{ $diary->mood }}</div>
        <div>{{ $diary->diary_content }}</div>
        @endif
    
        {{-- <div>{{ $diary->teacherComment->comment }}</div> --}}
    </div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    ＋
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">授業</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('lesson.store') }}" method="post">
            @csrf
            <input type="text" name="period">
            <input type="text" name="subject_id">
            <input type="text" name="content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
            </form>
      </div>
    </div>
  </div>

{{-- student --}}
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
    追加
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">感想</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('response.store') }}" method="post">
            @csrf
            <input type="text" name="lesson_id">
            <input type="text" name="understanding">
            <input type="text" name="comment">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
            </form>
      </div>
    </div>
  </div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
