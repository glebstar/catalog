<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каталог товаров</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
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
                    <form action="/basket" method="post">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }} р.</td>
                        <td><input name="count" type="number" min="1" value="1"> </td>
                        <td>
                            <input type="submit" class="btn btn-primary" value="Добавить в корзину">
                        </td>
                    </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
