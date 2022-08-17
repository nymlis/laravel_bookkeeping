<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>総勘定元帳</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="back-link">
            &laquo; <a href="{{ route('index') }}">一覧に戻る</a>
        </div>

        <h1>勘定科目選択</h1>
        <form action="{{ route('general_ledger.show') }}" method="post">
            @csrf

            <table border="1" bordercolor="black" class="">
                <tr>
                    <th>勘定科目</th>
                </tr>
                <tr>
                    <td>
                        <select name="account">
                            @foreach ($accounts_list as $account)
                            <option value="{{ $account }}" @if (strpos($account, '-') !== false || $account === '') disabled @endif>{{ $account }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td align="center" width="45px" class="form_border_none">
                        <button>選択</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
