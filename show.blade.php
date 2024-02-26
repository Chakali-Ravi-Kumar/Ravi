@extends('students.layout')
@section('content')

<div class="card">
    <div class="card-header">
        Students page
    </div>

    <h5 class="card-title">Name : {{$students->name}}</h5>
    <p class="card-text">Address : {{$students->address}}</p>
    <p class="card-text">Mobile : {{$students->mobile}}</p>
    <hr>

</div>
@endsection