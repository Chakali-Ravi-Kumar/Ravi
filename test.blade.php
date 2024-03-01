@php
   $container = "Random value" ;

   $colors = ["orange","red","blue","pink"];
@endphp

<script>
    // var $value = {{ $container }}
    // console.log($value);


    // TO make use of php variables in javascript use the directive atjson it converts php data into json which will understandable to any programming lang
    var value = @json($container);
    console.log(value);

    // var data = @json($colors);
    // console.log(data);

    var data = {{ Js::from($colors) }};   // making use of php vars in javascript by using blade templete


    data.forEach(function(entry){
        console.log(entry);
    });

</script>