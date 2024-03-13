<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('home', [
            'products' => Product::get(),
        ]);
    }

    public function basket(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('basket', [
            'products' => Product::get(),
        ]);
    }

    public function addOrder(OrderRequest $request): \Illuminate\Http\JsonResponse
    {
        $title = '';
        $price = 0;
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            $title .= $product->title . ', ';
            $price += $product->price * $item['count'];
        }

        $title = preg_replace('/, $/', '', $title);
        if (mb_strlen($title) > 255) {
            $title = mb_substr($title, 0, 254);
        }

        Order::create([
            'user_token' => $request->user,
            'titles' => $title,
            'price' => $price,
        ]);

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function orders(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (isset($request->user)) {
            return response()->json(Order::where('user_token', $request->user)->get());
        }

        return view('orders');
    }
}
