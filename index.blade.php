<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products CRUD </title>
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
        <div class="offset-10">
            <a href="products/create" class="btn btn-dark mt-md-3">New Product</a>
        </div>
        {{-- <h1> Product</h1> --}}

        <table class="table table-hover mt-md-5">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    
                <tr>
                    <td> {{ $loop->index+1 }} </td> 
                    <td><a href="products/{{ $product->id }}/show" class="text-dark" style="text-decoration: none">{{ $product->name }}</a></td>
                    <td>
                        <img src="{{ Storage::url('products/'. $product->image) }}" alt="" class="rounded-circle" width="50" height="50">
                    </td>
                    <td>
                        <a href="products/{{ $product->id }}/edit" class="btn btn-dark btn-sm">Edit</a>

                        <a href="products/{{ $product->id }}/delete" class="btn btn-danger btn-sm">Delete</a>
                    </td>

                    {{-- <td>
                        <a href="products/{{ $product->id }}/delete" class="btn btn-danger btn-sm ml-md-n5">Delete</a>
                    </td> --}}

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</body>
</html>