<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Product;

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
        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function orders()
    {

    }
}
