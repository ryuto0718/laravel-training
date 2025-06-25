<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>株式会社グリーンテックが購入していない商品</title>
</head>
<body>
    <h2>株式会社グリーンテックが購入していない商品</h2>
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>
</body>
</html>