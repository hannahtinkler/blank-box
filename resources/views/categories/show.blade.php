@extends('layouts.master')

@section('content')

<h1>{{ $category->title }}</h1>

<hr>

@if($category->description)
    <p>{!! $category->description !!}</p>
@endif

<h2 class="top-offset-2">Category Chapters:</h2>
<ul class="chapter-list">
    @foreach($category->chapters as $chapter)
        <li>
            <h4><i class="fa fa-folder-open-o"></i> <a href="/p/{{ $category->slug }}/{{ $chapter->slug }}">{{ $chapter->title }}</a></h4>
            <p>{!! substr($chapter->description, 0, 500) . (strlen($chapter->description) > 500 ? '...' : null)!!}</p>
        </li>
    @endforeach
</ul>

@stop


@section('scripts')

@stop
