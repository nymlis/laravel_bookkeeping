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
                                <option value="{{ $account }}" @if (old('account', $account) === $selected_account) selected @endif @if (strpos($account, '-') !== false || $account === '') disabled @endif>{{ $account }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td align="center" width="45px" class="form_border_none">
                        <button>選択</button>
                    </td>
                </tr>
            </table>
        </form>

        <h1>{{ $selected_account }} 総勘定元帳</h1>
        <table border="1" bordercolor="black" class="general_ledger">
            <tr>
                <th>日付</th>
                <th>借方勘定科目</th>
                <th>金額</th>
            </tr>

            @foreach ($debit_records as $debit_record)
                <tr>
                    <td align="center" width="120px">{{ $debit_record->date }}</td>
                    <td align="center" width="120px">{{ $debit_record->credit_accounts }}</td>
                    <td align="center" width="120px">{{ $debit_record->credit_price }}</td>
                </tr>
            @endforeach
        </table>
        <table border="1" bordercolor="black" class="general_ledger">
            <tr>
                <th>日付</th>
                <th>貸方勘定科目</th>
                <th>金額</th>
            </tr>

            @foreach ($credit_records as $credit_record)
                <tr>
                    <td align="center" width="120px">{{ $credit_record->date }}</td>
                    <td align="center" width="120px">{{ $credit_record->debit_accounts }}</td>
                    <td align="center" width="120px">{{ $credit_record->debit_price }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
