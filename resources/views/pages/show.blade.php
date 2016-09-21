@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->category->title }} - {{ $page->chapter->title }}</h1>
@include('partials.page_options')
<h2>
    {{ $page->title }}
    @if($page->approved === null)
        <span class="label label-warning m-l-sm"><i class="fa fa-flag"></i> Pending Curation</span>
    @elseif($page->approved === 0)
        <span class="label label-danger m-l-sm"><i class="fa fa-remove"></i> Rejected</span>
    @endif
</h2>

<h4 class="m-t-xl m-b-lg">{{ $page->description }}</h4>

<hr>

@if(session('message'))
    <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
@endif

{!! decodeFromCkEditor($page->content) !!}

<div class="m-t-lg green-text">
    <small>Written by <strong><a href="/u/{{ $page->creator->slug }}">{{ $page->creator->name }}</a></strong>
    @if($page->hasEdits()) 
        @set('updators', $page->getUpdatorsString())
        @if(strlen($updators) <= 160)
            and updated by {!! $page->getUpdatorsString() !!}
        @else
            and updated by many other lovely people
        @endif
    @endif
    </small>
</div>

@stop

@section('scripts')

@stop
