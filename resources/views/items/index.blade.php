@extends('layouts.app')

@section('content')

    <h1>What ot take</h1>

    @include('layouts/search')
    
    @include('items/items')

    @include('weather/weather')

@endsection