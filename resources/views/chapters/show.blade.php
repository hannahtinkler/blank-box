@extends('layouts.master')

@section('content')

<h1>{{ $chapter->category->title }} - {{ $chapter->title }}</h1>

<hr>

@if($chapter->description)
    <p>{!! $chapter->description !!}</p>
@endif

<h2 class="top-offset-2">Chapter Pages:</h2>
<ul class="chapter-list">
    @foreach($chapter->pages as $page)
        <li>
            <h3><i class="glyphicon glyphicon-file"></i> <a href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->slug }}/{{ $page->slug }}">{{ $page->title }}</a></h3>
            <p>{!! substr($page->description, 0, 500) . (strlen($page->description) > 500 ? '...' : null)!!}</p>
        </li>
    @endforeach
</ul>

@stop


@section('scripts')

@stop
