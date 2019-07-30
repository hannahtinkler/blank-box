@extends('layouts.master')

@section('content')

<h1>Your Bookmarks</h1>

<hr>

<p>Add bookmarks by clicking the large bookmark icon in the upper right of chapter and page windows. These bookmarks will appear on this page for future ease of access.</p>

<ul class="chapter-list">
    @foreach($bookmarks as $bookmark)
        <li class="m-b-xl">
        @if($bookmark->page_id != null)
            <h4>
                <a target="_blank" href="/p/{{ $bookmark->category->slug }}/{{ $bookmark->chapter->slug }}/{{ $bookmark->page->slug }}">
                    <i class="glyphicon glyphicon-file"></i> {{ $bookmark->page->title }}
                </a>
            </h4>
            <h5 class="m-l-md">
                <a target="_blank" href="/p/{{ $bookmark->category->slug }}">
                    {{ $bookmark->chapter->category->title }}
                </a>
                <a target="_blank" href="/p/{{ $bookmark->category->slug }}/{{ $bookmark->chapter->slug }}">
                    > {{ $bookmark->chapter->title }}
                </a>
                <p class="m-t-sm">Created {{ $bookmark->created_at->format('jS F Y H:ia') }}</p>
            </h5>
            <p class="m-l-md">{!! substr($bookmark->page->description, 0, 500) . (strlen($bookmark->page->description) > 500 ? '...' : null)!!}</p>
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
