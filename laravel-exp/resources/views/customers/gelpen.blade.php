<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ジェルボールペン（黒）を購入したことがある顧客</title>
</head>
<body>
    <h2>ジェルボールペン（黒）を購入したことがある顧客</h2>
    <ul>
    @foreach ($customers as $customer)
        <li>{{ $customer->name }}</li>
    @endforeach
    </ul>
</body>
</html>