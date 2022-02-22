@extends('layouts.app')
{{-- @section(‘page_title’, ‘’) --}}

@section('cdn')
<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/services/services-web.min.js"></script>
@endsection

@section('content')
<div id="app">
    {{-- Vue Router --}}
</div>
@endsection