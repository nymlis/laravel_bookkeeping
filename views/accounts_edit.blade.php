<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>勘定科目編集</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="back-link">
            &laquo; <a href="{{ route('index') }}">一覧に戻る</a>
        </div>

        <h1>勘定科目編集</h1>
        <form action="{{ route('accounts.update', $account) }}" method="post">
            @method('PATCH')
            @csrf

            <table border="1" bordercolor="black" class="">
                <tr>
                    <th>勘定科目</th>
                    <th>分類</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="name" value="{{ old('name', $account->name) }}">
                    </td>
                    <td>
                        <select name="category">
                            <option value="費用" @if (old('category', $account->category) === '費用') selected @endif>費用</option>
                            <option value="収益" @if (old('category', $account->category) === '収益') selected @endif>収益</option>
                            <option value="資産" @if (old('category', $account->category) === '資産') selected @endif>資産</option>
                            <option value="負債" @if (old('category', $account->category) === '負債') selected @endif>負債</option>
                            <option value="純資産" @if (old('category', $account->category) === '純資産') selected @endif>純資産</option>
                        </select>
                    </td>
                    <td align="center" width="45px" class="form_border_none">
                        <button>編集</button>
                    </td>
                </tr>
            </table>
        </form>

        <h1>勘定科目一覧</h1>
        <table border="1" bordercolor="black" class="">
            <tr>
                <th>勘定科目</th>
                <th>分類</th>
            </tr>

            @foreach ($accounts as $account)
                <tr>
                    <td align="center" width="120px">{{ $account->name }}</td>
                    <td align="center" width="120px">{{ $account->category }}</td>
                    <td align="center" width="45px" class="form_border_none">
                        <form action="{{ route('accounts.edit', $account) }}" method="get">
                            @csrf

                            <button>編集</button>
                        </form>
                    </td>
                    <td align="center" width="45px" class="form_border_none">
                        <form action="{{ route('accounts.destroy', $account) }}" method="post">
                            @method('DELETE')
                            @csrf

                            <button>削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
</body>
</html>
