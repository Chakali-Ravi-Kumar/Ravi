@extends('layouts.masterlayout')   {{-- it will load the complete design  layout from one page to another page --}}





@section('content')         {{-- Making content to come dynamic --}}

{{-- <h1>Home Page</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae obcaecati quod consequatur sequi, reiciendis soluta ipsum dolore, nobis ea minima, placeat tenetur temporibus dolorem voluptas illum. Eius dolorum deleniti odit, ipsa commodi doloribus dolores aspernatur harum magnam accusamus inventore placeat reprehenderit error, officia dicta, illo dignissimos vitae assumenda veritatis repudiandae excepturi. Repellendus quisquam autem ullam optio laboriosam praesentium laborum aliquid quis soluta odio molestiae, ea culpa animi non, quae dolorum qui maiores fugiat itaque exercitationem id vero ab? Doloremque, ratione expedita. Dolore assumenda velit quaerat minus doloribus nam sint molestiae! Voluptas aliquid, commodi repellendus exercitationem quidem nulla accusamus corporis. Error.</p> --}}
    
@endsection

@section('title')
    Home
@endsection


{{-- multie sections with same name we cannot use in same page --}}
@section('content')

<h2>Multiple sections in one Page</h2>
    
@endsection


{{-- To add javascript files in the pages use push directirive --}}
@push('scripts')

<script src="/bootstrap.js"></script>
<script src="/jquery.js"></script>
<script src="/homepage.js"></script>

    
@endpush

{{--  we can make use of multiple times same directive with same name --}}
@push('scripts')
<script src="/aboutus.js"></script>
    
@endpush


{{-- push directive is also used to link css files  --}}
@push('styles')
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/carousel.css">
@endpush


{{-- applying inpage css to the perticular page by using prepend directive --}}
@prepend('styles')
    <style>
        .main-content{
            background-color: cyan;
        }
    </style>
@endprepend