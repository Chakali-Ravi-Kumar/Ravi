<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                {{--  --}}
                <form action="{{ route('update.startup',$data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">                
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Location</label>
                        <input type="text" name="location" value="{{ $data->location }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">CEO</label>
                        <input type="text" name="ceo" value="{{ $data->ceo }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Type</label>
                        <input type="text" name="type" value="{{ $data->type }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">No of Workers</label>
                        <input type="text" name="noofworkers" value="{{ $data->noofworkers }}" class="form-control">
                    </div>
                    <button type="submit"  class="btn btn-primary btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>