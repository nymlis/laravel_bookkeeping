<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>仕訳帳</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="back-link">
            &laquo; <a href="{{ route('index') }}">一覧に戻る</a>
        </div>

        <h1>新規仕訳</h1>
        <form action="{{ route('journals.create') }}" method="post">
            @csrf

            <table border="1" bordercolor="black" class="input_journals">
                <tr>
                    <th>日付</th>
                    <th>借方勘定科目</th>
                    <th>金額</th>
                    <th>貸方勘定科目</th>
                    <th>金額</th>
                    <th>摘要</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="date" value="{{ old('date') }}">
                    </td>
                    <td>
                        <select name="debit_accounts">
                            @foreach ($accounts_list as $account)
                            <option value="{{ $account }}" @if (strpos($account, '-') !== false || $account === '') disabled @endif>{{ $account }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="debit_price" value="{{ old('debit_price') }}">
                    </td>
                    <td>
                        <select name="credit_accounts">
                            @foreach ($accounts_list as $account)
                            <option value="{{ $account }}" @if (strpos($account, '-') !== false || $account === '') disabled @endif>{{ $account }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="credit_price" value="{{ old('credit_price') }}">
                    </td>
                    <td>
                        <input type="text" name="summary" value="{{ old('summary') }}">
                    </td>
                    <td align="center" width="45px" class="form_border_none">
                        <button>追加</button>
                    </td>
                </tr>
            </table>
        </form>

        <h1>仕訳帳</h1>
        <table border="1" bordercolor="black" class="journals">
            <tr>
                <th>日付</th>
                <th>借方勘定科目</th>
                <th>金額</th>
                <th>貸方勘定科目</th>
                <th>金額</th>
                <th>摘要</th>
            </tr>

            @foreach ($journals as $journal)
                <tr>
                    @php
                        $journal->debit_price = number_format($journal->debit_price);
                        $journal->credit_price = number_format($journal->credit_price);
                    @endphp

                    <td align="center" width="120px">{{ $journal->date }}</td>
                    <td align="center" width="120px">{{ $journal->debit_accounts }}</td>
                    <td align="right" width="80px">{{ $journal->debit_price }}</td>
                    <td align="center" width="120px">{{ $journal->credit_accounts }}</td>
                    <td align="right" width="80px">{{ $journal->credit_price }}</td>
                    <td align="left">{{ $journal->summary }}</td>
                    <td align="center" width="45px" class="form_border_none">
                        <form action="{{ route('journals.edit', $journal) }}" method="get">
                            @csrf

                            <button>編集</button>
                        </form>
                    </td>
                    <td align="center" width="45px" class="form_border_none">
                        <form action="{{ route('journals.destroy', $journal) }}" method="post">
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
