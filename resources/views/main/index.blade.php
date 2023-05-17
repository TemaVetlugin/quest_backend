@extends('layouts.main')

@section('content')
<div id="message" data-message="{{ session('message') }}">
    <Index></Index>
</div>
@endsection
