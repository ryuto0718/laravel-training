<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>顧客一覧</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main>
    <h1>顧客マスタに登録されている顧客一覧</h1>
    <form action="/admin/customer" method="POST">
        @csrf
        <p>新規顧客名：
            <input type="text" name="name">
            <input type="submit" value="登録">
        </p>
    </form>
    <hr>


    <div class="a"> 
        @foreach ($customers as $customer)
        <form action="{{route('customer.update',['id' => $customer->id])}}" method="POST">
            @csrf
            @method('PUT')
                <input type="text" name="name" value="{{$customer->name}}">
                <input type="submit" value="更新"><br>
        </form>
        @endforeach
    </div>

        
    <div class="b">
        <form action="/admin/customer" name="delete" method="POST">
            @csrf
            @method('DELETE')
            @foreach ($customers as $customer)
                <input type="checkbox" name="ids[]" value="{{ $customer->id }}"><br>
            @endforeach
    </div>
        <input type="submit" value="削除">
    </form>
    </main>
</body> 
</html>



