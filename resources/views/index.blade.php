@extends('layouts.app')

@section('content')
    <script>
        var pageData = {
          cart: @json($cart)
        };
    </script>
    <cart></cart>
@endsection
