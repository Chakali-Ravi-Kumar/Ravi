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

    {{-- To show alert messages after doing any operation --}}
    @if ($message = Session::get('success'))

    <div class="alert alert-success alert-block">
        <strong> {{ $message }} </strong>

    </div>
        
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card mt-md-5 p-3">
                    <h3 class="text-muted">Product Edit # {{ $product->name }}</h3>
                    <form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label><br>
                            <input type="text" name="name" class="form-control" value="{{ old('name',$product->name) }}">   {{-- old(field_name) function stores the value entered in the input field even after hitting the submit button --}}
                            @if($errors->has('name'))

                            <span class="text-danger"> {{ $errors->first('name') }} </span>  {{-- This is validation part --}}

                            @endif
                        </div>

                        <div class="form-group mt-md-3">
                            <label for="">Description</label><br>
                            <textarea class="form-control" name="description"  id="" cols="30" rows="6"> {{ old('description',$product->description) }} </textarea>
                            @if($errors->has('description'))
                            <span class="text-danger"> {{ $errors->first('description') }} </span>

                            @endif
                        </div>

                        <div class="form-group mt-md-3">
                            <label for="">Image</label><br>
                            <input type="file" name="image" class="form-control">
                            @if ($errors->has('image'))
                            <span class="text-danger"> {{ $errors->first('image') }} </span>
                                
                            @endif
                        </div>
                        <div class="mt-md-5">
                            <img src="{{ Storage::url('products/'. $product->image) }}" alt="" class="rounded-circle" width="80" height="80">

                        </div>

                        <div class="form-group mt-md-5">
                            <button type="submit" class="btn btn-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>