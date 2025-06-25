<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>株式会社グリーンテック（顧客ID:1）が購入した商品</title>
</head>
<body>
    <h2>株式会社グリーンテック（顧客ID:1）が購入した商品</h2>
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>
</body>
</html>