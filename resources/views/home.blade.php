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
            <tr>
                <th>1</th>
                <td>国語</td>
                <td>ごんぎつね</td>
                <td>〇</td>
                <td>コメント</td>
            </tr>
            <tr>
                <th>2</th>
                <td>国語</td>
                <td>ごんぎつね</td>
                <td>〇</td>
                <td>コメント</td>
            </tr>
            <tr>
                <th>3</th>
                <td>国語</td>
                <td>ごんぎつね</td>
                <td>〇</td>
                <td>コメント</td>
            </tr>
            <tr>
                <th>4</th>
                <td>国語</td>
                <td>ごんぎつね</td>
                <td>〇</td>
                <td>コメント</td>
            </tr>
            <tr>
                <th>5</th>
                <td>国語</td>
                <td>ごんぎつね</td>
                <td>〇</td>
                <td>コメント</td>
            </tr>
            <tr>
                <th>6</th>
                <td>国語</td>
                <td>ごんぎつね</td>
                <td>〇</td>
                <td>コメント</td>
            </tr>
        </table>
    </div>
    <div class="bottom_content">
        <div>日記</div>
        <div>〇</div>
        <div><p>aaaaaaaaaaaaa</p></div>
        <div>コメント</div>
    </div>
</body>
</html>
