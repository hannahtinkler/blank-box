@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->category->title }} - {{ $page->chapter->title }}</h1>
@include('partials.page_options')
<h2>
    {{ $page->title }}
    @if(!$page->approved)
        <span class="label label-warning m-l-sm"><i class="fa fa-flag"></i> Pending Curation</span>
    @endif
</h2>

<hr>

@if(session('message'))
    <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
@endif

<div class="m-b-lg">
    {!! $page->content !!}
</div>

<div class="m-t-lg">
    @foreach($page->pageTags as $pageTag)
        <span class="tag label m-r-sm"><i class="fa fa-tag m-r-xs"></i> {{ $pageTag->tag->tag }}</span>
    @endforeach
</div>
<div class="m-t-sm m-b-lg green-text">
    <small>Added by <strong><a href="/u/{{ $page->creator->slug }}">{{ $page->creator->name }}</a></strong>
    @if($page->hasEdits()) 
        and kept up-to-date by {!! $page->getUpdatorsString() !!}
    @endif
    </small>
</div>

@stop

@section('scripts')

@stop
