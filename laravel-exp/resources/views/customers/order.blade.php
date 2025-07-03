<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>2025年6月に注文した顧客リスト</title>
</head>
<body>
    <h2>2025年6月に注文した顧客リスト</h2>
    <ul>
    @foreach ($customers as $customer)
        <li>{{ $customer->name }} <br>合計金額：{{$customer->price}}円 </li><br>
    @endforeach
    </ul>
</body>
</html>