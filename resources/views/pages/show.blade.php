@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->category->title }} - {{ $page->chapter->title }}</h1>
@include('partials.page_options')
<h2>{{ $page->title }}</h2>

<hr>

@if(session('message'))
    <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
@endif

{!! $page->content !!}

@stop

@section('scripts')

@stop
