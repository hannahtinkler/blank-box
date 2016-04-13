@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->title }}</h1>
<h2>{{ $page->title }}</h2>

<hr>

{!! $page->content !!}

@stop


@section('scripts')

@stop
