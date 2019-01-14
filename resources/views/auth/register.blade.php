@extends('layouts.app')

@section('title', __('member_register'))

@section('js')
    @parent
    <script>
        var pageData = {
            returnUrl: '/home', // TODO
        };
    </script>
@endsection

@section('content')
    <register></register>
@endsection
