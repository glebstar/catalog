@extends('layout.main')

@section('content')
    <script>
        let products = [];
        let product = null;
    </script>
    @foreach($products as $product)
        <script>
            product = localStorage.getItem('product-' + {{ $product->id }});
            if (product) {
                product = JSON.parse(product);
                product.title = '{{ $product->title }}';
                products.push(product);
            }
        </script>
    @endforeach
    <h1>Корзина</h1>
    <table class="table">
        <thead>
            <th>Название</th>
            <th>Количество</th>
        </thead>
        <tbody id="tbody">

        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right;">Общая стоимость: <span id="comPrice">0</span> р.
                    <button id="btnOrder" class="btn btn-success" style="display: none;" onclick="return addOrder();"><i class="bi-bag-check"></i> Оформить заказ</button></td>
            </tr>
        </tfoot>
    </table>
    <script>
        let tbody = document.getElementById('tbody');
        let comPrice = 0;
        for(let i=0;i<products.length;i++) {
            tbody.insertAdjacentHTML('beforeend', '<tr><td>' + products[i].title + '</td><td>' + products[i].count + '</td></tr>');
            comPrice = parseInt(comPrice) + (parseFloat(products[i].price) * parseInt(products[i].count));
        }

        if (comPrice > 0) {
            document.getElementById('btnOrder').style.display = 'inline';
            document.getElementById('comPrice').innerHTML = comPrice;
        }
    </script>
@endsection

@section('scripts')
    <script>
        function addOrder()
        {
            $('#btnOrder').hide();
            $.post('/order', {
                _token: '{{ csrf_token() }}',
                user: currentUser,
                products: products
            }, 'json')
                .done(function(data){
                    if (data.status == 'ok') {
                        //localStorage.clear();
                        //window.location = '/orders';
                    } else {
                        alert(data.message);
                    }
                    console.log(data);
                })
                .fail(function(xhr, status, error) {
                    alert('Ошибка при добавлении заказа');
                    $('#btnOrder').show();
                });

            return false;
        }
    </script>
@endsection
