<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-md-5">
                <h1>User Details</h1>
                {{-- <pre>
                    @php
                        print_r($errors->all());
                    @endphp
                </pre> --}}


                {{-- any() finds if any errors exists and $errors is a super global variable used to find errors --}}
                {{-- @if ($errors->any())    

                <ul class="alert alert-danger" style="list-style-position: inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                    
                @endif --}}
                <form action="{{ route('addUser') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-lable">Name</label><br>
                        <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username">
                        <span class="text-danger">
                            @error('username')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-lable">Email</label><br>  
                        <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div> 
                    <div class="mb-3">
                        <label for="" class="form-lable">Password</label>       
                        <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-lable">Age</label><br>
                        <input type="text" value="{{ old('age') }}" class="form-control @error('age') is-invalid @enderror" name="age">
                        <span class="text-danger">
                            @error('age')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-lable">City</label><br>
                        <select name="" id=""  class="form-control">
                            <option value="bangalore">Banglore</option>
                            <option value="hyderabad">Hyderabad</option>
                            <option value="chenni">Chenni</option>
                            <option value="pune">Pune</option>
                            <option value="mumbai">Mumbai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-md-4">Submit</button>


                </form>
            </div>
        </div>
    </div>
</body>
</html>