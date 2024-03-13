@extends('layout.main')

@section('content')
    <h1>Все заказы</h1>
    <table class="table">
        <thead>
        <th>№ заказа</th>
        <th>Название</th>
        <th>Сумма</th>
        </thead>
        <tbody id="tbody"></tbody>
        <tfoot>
        <tr>
            <td colspan="3" style="text-align: right;">Итого: <span id="comPrice">0</span> р.</td>
        </tr>
        </tfoot>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            let comPrice = 0;
            $.get('/orders?user=' + currentUser, function(data){
                for(let i=0; i<data.length; i++) {
                    $('#tbody').append('<tr><td>' + data[i].id + '</td><td>' + data[i].titles + '</td><td>' + data[i].price + ' р.</td></tr>')
                    comPrice = parseFloat(comPrice) + parseFloat(data[i].price);
                }
                $('#comPrice').html(comPrice);
            }, 'json');
        });
    </script>
@endsection
