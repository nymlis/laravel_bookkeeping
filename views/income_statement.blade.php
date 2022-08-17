<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>損益計算書</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="back-link">
            &laquo; <a href="{{ route('index') }}">一覧に戻る</a>
        </div>

        <h1>期間選択 (未実装)</h1>
        <form action="" method="post">
            @csrf

            <table border="1" bordercolor="black" class="">
                <tr>
                    <th>期間</th>
                </tr>
                <tr>
                    <td>
                        <select name="">
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </td>
                    <td align="center" width="45px" class="form_border_none">
                        <button>選択</button>
                    </td>
                </tr>
            </table>
        </form>

        <h1>損益計算書</h1>
        <table border="1" bordercolor="black" class="">
            @foreach ($PL_table as $record)
                <tr>
                    <td align="center" width="120px">{{ $record[0] }}</td>
                    <td align="right" width="120px">{{ $record[1] }}</td>
                    <td align="right" width="120px">{{ $record[2] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
