@extends('layouts.app')

@section('title', __('member_login'))

@section('js')
    @parent
    <script>
        var pageData = {
            returnUrl: '/', // TODO
        };
    </script>
@endsection

@section('content')
    <login></login>
@endsection
