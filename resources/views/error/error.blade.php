@extends('layouts.app')

@section('content')

    <div class="error">

        @switch($error->error->code)
            @case(404)
                <h1>{{ $error->error->code }}</h1>
                <p>We could not find what you are looking for</p>
                @break
            @case(500)
                <h1>{{ $error->error->code }}</h1>
                <p>The server pooped itself</p>
                @break
            @default
                <h1>Uhhh....</h1>
                <p>Something just broke</p>
        @endswitch

        <p>Sorry for the truble</p>
    </div>

@endsection
