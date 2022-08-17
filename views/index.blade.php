<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>複式簿記</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="index">
            <button onclick="location.href='{{ route('journals') }}'">仕訳帳</button>
            <button onclick="location.href='{{ route('general_ledger') }}'">総勘定元帳</button>
            <button onclick="location.href='{{ route('balance_sheet') }}'">貸借対照表</button>
            <button onclick="location.href='{{ route('income_statement') }}'">損益計算書</button>
            <button onclick="location.href='{{ route('accounts') }}'">勘定科目編集</button>
        </div>
    </div>
</body>
</html>
