@extends('layout.main')

@section('content')
    <h1>Все товары</h1>

    <table class="table">
        <thead>
        <th>Название</th>
        <th>Цена</th>
        <th>Количество</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($products as $product)
            <form id="basket-form" action="#" onsubmit="return addToBasket({{ $product->id }});">
                <tr>
                    <td>{{ $product->title }}</td>
                    <td><span id="price-{{ $product->id }}">{{ $product->price }}</span> р.</td>
                    <td><input id="count-{{ $product->id }}" name="count" type="number" min="1" value="1"> </td>
                    <td>
                        <input type="submit" class="btn btn-outline-primary" value="Добавить в корзину">
                    </td>
                </tr>
            </form>
        @endforeach
        </tbody>
    </table>
    <script>
        function addToBasket(productId)
        {
            let product = localStorage.getItem('product-' + productId);
            if (!product) {
                product = {
                    id: productId,
                    count: document.getElementById('count-' + productId).value,
                    price: document.getElementById('price-' + productId).innerHTML
                };
            } else {
                product = JSON.parse(product);
                product.count = parseInt(product.count) + parseInt(document.getElementById('count-' + productId).value);
            }
            localStorage.setItem('product-' + productId, JSON.stringify(product));

            window.location = '/basket';

            return false;
        }
    </script>
@endsection
