@extends('layouts.master')

@section('content')

<h1>Your Bookmarks</h1>

<hr>

<p>Add bookmarks by clicking the orange bookmark icon in the upper right of chapter and page windows. These bookmarks will appear on this page for future ease of access.</p>

<ul class="chapter-list">
    @foreach($bookmarks as $bookmark)
        <li>
        @if($bookmark->page_id != null)
            <h4>
                <i class="glyphicon glyphicon-file"></i>
                <a target="_blank" href="/p/{{ $bookmark->category->slug }}/{{ $bookmark->chapter->slug }}/{{ $bookmark->page->slug }}">
                    {{ $bookmark->chapter->category->title }} > {{ $bookmark->chapter->title }} > {{ $bookmark->page->title }}
                </a>
                <span>Created {{ $bookmark->created_at->format('jS F Y H:ia') }}</span>
            </h4>
            <p>{!! substr($bookmark->page->description, 0, 500) . (strlen($bookmark->page->description) > 500 ? '...' : null)!!}</p>
        @else
            <h4>
                <i class="fa fa-folder-open-o"></i>
                <a target="_blank" href="/p/{{ $bookmark->category->slug }}/{{ $bookmark->chapter->slug }}">
                    {{ $bookmark->chapter->category->title }} > {{ $bookmark->chapter->title }}
                </a>
                <span>Created {{ $bookmark->created_at->format('jS F Y H:ia') }}</span>
            </h4>
            <p>{!! substr($bookmark->chapter->description, 0, 500) . (strlen($bookmark->chapter->description) > 500 ? '...' : null)!!}</p>
        @endif
        </li>
    @endforeach
</ul>

@stop


@section('scripts')

@stop
