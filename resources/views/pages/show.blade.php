@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->category->title }} - {{ $page->chapter->title }}</h1>
<h2>{{ $page->title }}</h2>

<hr>

@if(session('message'))
    <p class="bg-success error-message"><i class="glyphicon glyphicon-check"></i> {!! session('message') !!}</p>
@endif

{!! $page->content !!}

@stop


@section('scripts')

@stop
