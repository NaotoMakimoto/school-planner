@extends('layouts.app_original')
@section('content')
    <div class="top_content">
        {{-- <div>{{ $today }}</div> --}}
        <div class='top_content_left'>
            <form method="post" action="{{ route('tasks.store') }}">
                @csrf
                <input type="date" name="date" value="{{ $date }}" required>
                <button type="submit" class='btn_plus'>＋</button>
            </form> 
            <hr>
            <div class="top_content_left_bottom">
                @if($task)                  
                <p>{{ $task->announcements}}</p>
                @endif
            </div>
        </div>       
        <div class="top_content_right">
            <div class="taskbox">
                <h1>宿題</h1> 
                @if($task)                  
                <p>{{ $task->assignments}}</p>
                @endif
            </div>
            <div class="taskbox">
                <h1>持ち物</h1>
                @if($task)
                <p>{{ $task->belongings}}</p>
                @endif
            </div>
            <!-- タスク追加ボタン -->
            @if($user->role === 'Teacher')
            <button type="button" class="btn_plus" data-bs-toggle="modal" data-bs-target="#Modal_task">
                ＋
            </button>
            @endif
        </div>
        
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
                    @method('PUT')
                    <p>連絡事項</p>
                    <textarea name="announcements" cols="50" rows="5" >{{ $task->announcements ?? '' }}</textarea>
                    <p>宿題</p>
                    <textarea name="assignments" cols="50" rows="5" >{{ $task->assignments ?? '' }}</textarea>
                    <p>持ち物</p>
                    <textarea name="belongings" cols="50" rows="5" >{{ $task->belongings ?? '' }}</textarea>
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

    {{----- 授業 -------}}
    <div class="middle_content">
          <!-- 授業追加ボタン -->
    @if($user->role === 'Teacher')
    <button type="button" class="btn_plus" id="btn_class" data-bs-toggle="modal" data-bs-target="#exampleModal">
        ＋
    </button>
    @endif
  
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
            <input type="text" size="30" name="content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
            </form>
      </div>
    </div>
  </div>

        <p>理解度　1：うーん…　2：まあまあ　3：いい感じ　4：ほとんどできた　5：パーフェクト！</p>
        <table class="class_table">
           
            <tbody>
                @for ($i = 1; $i <= 6; $i++)
                    <tr>
                        <td class="td_period">{{ $i }}</td>
                        @php
                            $lesson = $lessons->firstWhere('period', $i);
                            if($lesson){
                                $studentLesson = $studentLessons->firstWhere('lesson_id', $lesson->id);
                            } else {
                                $studentLesson = null;
                            }
                        @endphp
                        <td class="td_subject">{{ $lesson->subject->name ?? '' }}</td>
                        <td class="td_content">{{ $lesson->content ?? '' }}</td>
                        <td class="td_understanding">{{ $studentLesson->understanding ?? '' }}
                            
                            {{-- @switch($lesson->understanding ?? '')
                            @case(1)
                                <img src="image/face_img1.png" alt="">
                                @break
                            @case(2)
                                <img src="image/face_img2.png" alt="">
                                @break
                            @case(3)
                                <img src="image/face_img3.png" alt="">
                                @break
                            @case(4)
                                <img src="image/face_img4.png" alt="">
                                @break
                            @case(5)
                                <img src="image/face_img5.png" alt="">
                                @break           
                            @endswitch --}}
                        </td>
                        <td class="td_comment">{{ $studentLesson->comment ?? '' }}</td>
                        <td class="td_btn">
                            <!-- 生徒の感想ボタン -->
                            @if($user->role === 'Student')
                            <button type="button" class="btn_plus" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $i }}">
                                ＋
                            </button>
                            @endif
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $i }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $i }}">{{ $i }}時間目　{{ optional(optional($lesson)->subject)->name }}　{{ optional($lesson)->content }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                
                                            <h5>どれくらい理解できたかな？</h5>
                                            <p>1：うーん…　2：まあまあ　3：いい感じ　4：ほとんどできた　5：パーフェクト！</p>
                                            <form action="{{ $lesson ? route('studentLessons.store', ['id' => $lesson->id]) : '' }}" method="post">
                                                @csrf
                                                <label>
                                                    <input type="radio" name="understanding" value="1" {{ optional($studentLesson)->understanding == 1 ? 'checked' : '' }}> 1　
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="2" {{ optional($studentLesson)->understanding == 2 ? 'checked' : '' }}> 2　
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="3" {{ optional($studentLesson)->understanding == 3 ? 'checked' : '' }}> 3　
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="4" {{ optional($studentLesson)->understanding == 4 ? 'checked' : '' }}> 4　
                                                </label>
                                                <label>
                                                    <input type="radio" name="understanding" value="5" {{ optional($studentLesson)->understanding == 5 ? 'checked' : '' }}> 5　
                                                </label>
                                                <br><br><br>
                                                <h5>感想</h5>
                                                <p>できるようになったこと・難しかったことを書こう</p>
                                                
                                                <input type="text" size='50' name="comment" value="{{ optional($studentLesson)->comment }}">
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


{{----------- 日記 ------------}}
  <div class="bottom_content">
    <div class="bottom_content_left">
        <div class="bottom_content_left_top">
            <h1>日記</h1>
        
            <!-- 今日の気分と日記を投稿するボタン -->
            @if($user->role === 'Student')
            <button type="button" class="btn_plus" data-bs-toggle="modal" data-bs-target="#exampleModal_diary">
                ＋
            </button>
            @endif

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
                        <p>今日の気分は？</p>
                        <label>
                            <input type="radio" name="mood" value="1" {{ optional($diary)->mood == 1 ? 'checked' : '' }}> 大変だった
                        </label>
                        <label>
                            <input type="radio" name="mood" value="2" {{ optional($diary)->mood == 2 ? 'checked' : '' }}> 疲れた～
                        </label>
                        <label>
                            <input type="radio" name="mood" value="3" {{ optional($diary)->mood == 3 ? 'checked' : '' }}> いい感じ
                        </label>
                        <label>
                            <input type="radio" name="mood" value="4" {{ optional($diary)->mood == 4 ? 'checked' : '' }}> ハッピー！
                        </label>
                        <label>
                            <input type="radio" name="mood" value="5" {{ optional($diary)->mood == 5 ? 'checked' : '' }}> 最高！！
                        </label>
    
                        <ul>
                            <li>
                              <label>
                                <input type="checkbox" name="questions[question1]" value="1" {{ optional($diary)->question1 == 1 ? 'checked' : '' }}>
                                <span class="checkbox-text">体調は良い</span>
                              </label>
                            </li>
                            <li>
                              <label>
                                <input type="checkbox" name="questions[question2]" value="1" {{ optional($diary)->question2 == 1 ? 'checked' : '' }}>
                                <span class="checkbox-text">友達と楽しく生活できている</span>
                              </label>
                            </li>
                            <li>
                              <label>
                                <input type="checkbox" name="questions[question3]" value="1" {{ optional($diary)->question3 == 1 ? 'checked' : '' }}>
                                <span class="checkbox-text">困っていることはない</span>
                              </label>
                            </li>
                        </ul>
                        
    
                        <p>今日あったことを書こう！</p>
                        <textarea name="content" cols="70" rows="5">{{ optional($diary)->content }}</textarea>
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
        
        <div class="mood_img_box">
            @switch(optional($diary)->mood)
                @case(1)
                    <img src="image/face_img1.png" alt="">
                    @break
                @case(2)
                    <img src="image/face_img2.png" alt="">
                    @break
                @case(3)
                    <img src="image/face_img3.png" alt="">
                    @break
                @case(4)
                    <img src="image/face_img4.png" alt="">
                    @break
                @case(5)
                    <img src="image/face_img5.png" alt="">
                    @break           
                @endswitch
        </div>
        <div>
           <table>
                <tr>
                    <td class="check_box">
                        @if(optional($diary)->question1 == 1) 
                            <img src="image/red-check.jpeg" alt="">
                        @endif
                    </td>
                    <td>体調　</td>
                </tr>
                <tr>
                    <td class="check_box">
                        @if(optional($diary)->question2 == 1) 
                            <img src="image/red-check.jpeg" alt="">
                        @endif
                    </td>
                    <td>友達　</td>
                </tr>                
                <tr>   
                    <td class="check_box">
                        @if(optional($diary)->question3 == 1) 
                            <img src="image/red-check.jpeg" alt="">
                        @endif
                    </td>
                    <td>困りごと</td>
                </tr>
           </table>
        </div>
    </div>
<div class="bottom_content_right">
  

    <div class="diary_box">
        <div class="diary_box_left diary_text">{{ optional($diary)->content }}</div>
        <div class="diary_box_right">
            <p>{{ optional($diary)->comment }}</p>
    
               <!-- 先生のコメントボタン -->
            @if($user->role === 'Teacher')
            <button type="button" class="btn_plus" id="btn_teacher_comment" data-bs-toggle="modal" data-bs-target="#Modal_diary_comment">
                ＋
            </button>
            @endif

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
                        <textarea name="comment" cols="60" rows="5">{{ $diary->comment ?? '' }}</textarea>
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
    
    </div>
            
</div>
        
       
     

      
   

    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

