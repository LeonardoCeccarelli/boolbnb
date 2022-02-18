@extends('layouts.app')

{{-- @section('page_title', '') --}}

@section('content')

{{-- Qui Va il componente Vue --}}
<search-bar :services="{{ json_encode($services) }}"></search-bar>
@endsection