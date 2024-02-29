<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link text-light offset-3"><h2>Products</h2></a>
            </li>

        </ul>

    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-md-4">
                <div class="card p-4">

                    <p>Name : <b>{{ $product->name }}</b></p>
                    <p>Description : <b>{{ $product->description }}</b></p>
                    <img src="/products/{{ $product->image }}" alt="" class="rounded" width="100%">


                </div>
            </div>
        </div>
    </div>
</body>
</html>