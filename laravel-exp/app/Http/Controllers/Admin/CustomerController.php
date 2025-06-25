<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\CustomerPostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{

    //顧客一覧を表示
    public function customer(): View
    {
        $customers = Customer::select('id','name')->get();                  //顧客のidとnameを全件取得して
        return view('customers.customer',['customers' => $customers]);      //viewにcustomerという名前でデータを渡している
    }



    //新しい顧客を登録
    public function store(Request $request): RedirectResponse
    {
        $customer = new Customer();             //入力した顧客名が入る空の箱を作成
        $customer->name = $request->name;       //入力された顧客名を箱に代入
        $customer->save();                      //それをデータベースに保存

        return redirect(route('customer.customer'));        //顧客一覧ページに戻る
    }




    //顧客を削除
    public function destroy(Request $request): RedirectResponse
    {
        $ids = $request->input('ids', []);          //チェックボックスで選択されたidを配列で取得

        DB::transaction(function() use ($ids) {         //トランザクションを使って、安全に削除処理を実行
            Customer::whereIn('id', $ids)->delete();        // 一致するレコードをまとめて検索
        });

        return redirect(route('customer.customer'));
    }


    //顧客の更新
    public function update(Request $request,$id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->save();
        return redirect(route('customer.customer'));
    }


    
    public function noGelpen():View
        {
        $customers = Customer::WhereNotIn('id',function($query){$query->select('orders.customer_id')
        ->from('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->where('products.name', '=', 'ジェルボールペン（黒）');})
        ->select('name')
        ->get();

        return view('customers.nogelpen', ['customers' => $customers]);
    }



    public function gelpen():View
        {
        $customers = Customer::WhereIn('id',function($query){$query->select('orders.customer_id')
        ->from('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->where('products.name', '=', 'ジェルボールペン（黒）');})
        ->select('name')
        ->get();

        return view('customers.gelpen', ['customers' => $customers]);
    }

    public function order():View
    {
        $customers = Customer::join('orders','customers.id','=','orders.customer_id')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.order_date','>','2025-6-1')
        ->select('customers.name',DB::raw('SUM(products.price) as price'))
        ->groupBy('customers.id','customers.name')
        ->orderByRaw('price desc')
        ->get();

        return view('customers.order',['customers' => $customers]);
    }
}
