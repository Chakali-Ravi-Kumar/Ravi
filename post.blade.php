@extends('layouts.masterlayout')  {{-- it will load the complete layout from one page to another page --}}

@section('content')

<h1>Post Page</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae obcaecati quod consequatur sequi, reiciendis soluta ipsum dolore, nobis ea minima, placeat tenetur temporibus dolorem voluptas illum. Eius dolorum deleniti odit, ipsa commodi doloribus dolores aspernatur harum magnam accusamus inventore placeat reprehenderit error, officia dicta, illo dignissimos vitae assumenda veritatis repudiandae excepturi. Repellendus quisquam autem ullam optio laboriosam praesentium laborum aliquid quis soluta odio molestiae, ea culpa animi non, quae dolorum qui maiores fugiat itaque exercitationem id vero ab? Doloremque, ratione expedita. Dolore assumenda velit quaerat minus doloribus nam sint molestiae! Voluptas aliquid, commodi repellendus exercitationem quidem nulla accusamus corporis. Error.</p>
    
@endsection

{{-- @section('title')
    Post
@endsection --}}


@section('sidebar')     {{-- If we want to show any specific content in any page in any section  --}}
@parent     {{-- It loads parent content first and then the below code --}}
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste commodi deserunt architecto quae quis, voluptates odio similique. Magnam, laboriosam voluptas!</p>
    
@endsection

@push('scripts')

<script src="/postpage.js"></script>
    
@endpush


@push('styles')
    <link rel="stylesheet" href="css/postpage.css">
@endpush