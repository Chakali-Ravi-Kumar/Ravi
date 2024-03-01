@extends('layouts.masterlayout')    {{-- it will load the complete layout from one page to another page --}}

@section('content')

<h1>About Page</h1>
{{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae obcaecati quod consequatur sequi, reiciendis soluta ipsum dolore, nobis ea minima, placeat tenetur temporibus dolorem voluptas illum. Eius dolorum deleniti odit, ipsa commodi doloribus dolores aspernatur harum magnam accusamus inventore placeat reprehenderit error, officia dicta, illo dignissimos vitae assumenda veritatis repudiandae excepturi. Repellendus quisquam autem ullam optio laboriosam praesentium laborum aliquid quis soluta odio molestiae, ea culpa animi non, quae dolorum qui maiores fugiat itaque exercitationem id vero ab? Doloremque, ratione expedita. Dolore assumenda velit quaerat minus doloribus nam sint molestiae! Voluptas aliquid, commodi repellendus exercitationem quidem nulla accusamus corporis. Error.</p> --}}
    @verbatim
    <div id="app">{{ message }}</div>
    @endverbatim
@endsection

{{-- @section('content') --}}



@section('title')
    About
@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script>
            const { createApp, ref } = Vue
            createApp({
                setup() {
                const message = ref('Hello vue!')
                return {
                    message
                }
                }
            }).mount('#app')
        </script>
@endpush

