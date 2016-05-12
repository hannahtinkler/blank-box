@extends('layouts.master')

@section('content')


<h2 class="top-offset-2">Latest Updated Pages:</h2>
<ul class="chapter-list">
    
    
    @foreach($updatedPages as $page)
        <li>
            <a href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->slug }}/{{ $page->slug }}">{{ $page->title }}</a>
            <span> -- Updated on {{ date('jS M Y', strtotime(date($page->updated_at))) }}</span><br />
            <span>{{ $page->description }}</span><br />
            <span>Category: <a href="/p/{{ $page->chapter->category->slug }}">{{ $page->chapter->category->title }}</a></span><br />
            <span>Chapter: <a href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->title }}">{{ $page->chapter->title }}</a></span>
        </li>
    @endforeach

    {!! $updatedPages->links() !!}
    
</ul>

@stop

@section('scripts')

@stop
