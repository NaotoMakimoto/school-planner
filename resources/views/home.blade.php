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
        {{-- <div>{{ $today }}</div> --}}

        <form method="post" action="{{ route('tasks.store') }}">
            @csrf
            <input type="date" name="date" value="{{ $date }}" required>
            <button type="submit" class="btn btn-primary">選択</button>
        </form>
        
        <div>
            <div>
                <h1>宿題</h1> 
                @if($task)                  
                <div>{{ $task->assignments}}</div>
                @endif
                <h1>持ち物</h1>
                @if($task)
                <div>{{ $task->belongings}}</div>
                @endif
            </div>
           
        </div>
         <!-- タスク追加ボタン -->
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal_task">
            編集
        </button>
        <!-- Modal -->
        <div class="modal fade" id="Modal_task" tabindex="-1" aria-labelledby="ModalLabel_task" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel_task">宿題・持ち物</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ $task ? route('tasks.update', $task->id): '' }}" method="post">
                    @csrf
                    @method('put')
                    <textarea name="assignments" cols="30" rows="10" >{{ $task->assignments ?? '' }}</textarea>
                    <textarea name="belongings" cols="30" rows="10" >{{ $task->belongings ?? '' }}</textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
            </div>
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
                        <td>{{ $lesson->understanding ?? '' }}</td>
                        <td>{{ $lesson->comment ?? '' }}</td>
                        <td>
                            <!-- 生徒の感想ボタン -->
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $i }}">
                                感想
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $i }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $i }}">感想</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ $lesson ? route('lessons.update', $lesson->id) : '' }}" method="post">
                                                @csrf
                                                @method('put')
                                                <label>
                                                    <input type="radio" name="understanding" value="1"> bad
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="2"> a bit
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="3"> okay
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="4"> good
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="5"> excellent
                                                </label>
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
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

<!-- 授業追加ボタン -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    追加
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
            <form action="{{ route('lessons.store') }}" method="post">
            @csrf
            <select name="period">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
            <select name="subject_id">
                <option value="1">国語</option>
                <option value="2">算数</option>
                <option value="3">英語</option>
                <option value="4">社会</option>
                <option value="5">理科</option>
                <option value="6">道徳</option>
                <option value="7">体育</option>
                <option value="8">図工</option>
                <option value="9">音楽</option>
                <option value="10">家庭科</option>
                <option value="11">生活</option>
                <option value="12">総合</option>
                <option value="13">学活</option>
            </select>
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

  <div class="bottom_content">
        <div>日記</div>
        @if($diary)
        <div>{{ $diary->mood}}</div>
        <div>{{ $diary->content}}</div>
        <div>{{ $diary->comment }}</div>
        @endif
        <!-- 今日の気分と日記を投稿するボタン -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal_diary">
            日記
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal_diary" tabindex="-1" aria-labelledby="exampleModalLabel_diary" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel_diary">日記</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('diaries.store') }}" method="post">
                    @csrf
                    <label>
                        <input type="radio" name="mood" value="1"> bad
                    </label>
                    <label>
                        <input type="radio" name="mood" value="2"> a bit
                    </label>
                    <label>
                        <input type="radio" name="mood" value="3"> okay
                    </label>
                    <label>
                        <input type="radio" name="mood" value="4"> good
                    </label>
                    <label>
                        <input type="radio" name="mood" value="5"> excellent
                    </label>
                    <textarea name="content" cols="30" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
        <!-- 先生のコメントボタン -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal_diary_comment">
            コメント
        </button>
        <!-- Modal -->
        <div class="modal fade" id="Modal_diary_comment" tabindex="-1" aria-labelledby="ModalLabel_diary_comment" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel_diary_comment">先生のコメント</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ $diary ? route('diaries.update', $diary->id): '' }}" method="post">
                    @csrf
                    @method('put')
                    <textarea name="comment" cols="30" rows="10">{{ $diary->comment ?? '' }}</textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
