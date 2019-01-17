@extends('layouts.app')

@section('title', __('member_register'))

@section('js')
    @parent
    @inject('regionService', 'Gaia\Services\Region\RegionServiceInterface')
    <script>
        var pageData = {
            returnUrl: '/', // TODO
            countryList: @json($regionService->getCountryList()),
        };
    </script>
@endsection

@section('content')
    <register></register>
@endsection
