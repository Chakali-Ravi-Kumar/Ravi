@extends('students.layout')
@section('content')

<form action="{{ route('store') }}" method="post">
    
    @csrf
    <lable>Name</lable><br>
    <input type="text" name="name" id="name" class="form-control"><br>

    <lable>Address</lable><br>
    <input type="text" name="address" id="address" class="form-control"><br>

    <lable>Mobile</lable><br>
    <input type="number" name="mobile" id="mobile" class="form-control"><br>
    <input type="submit" value="Save" class="btn btn-success">

</form>

@endsection