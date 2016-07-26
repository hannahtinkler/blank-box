@extends('layouts.master')

@section('content')

<h1>
    {{ $user->name }}
    <div class="label label-success right"><i class="fa fa-flag"></i> Curator</div>
</h1>
<h2>{{ $user->email }}</h2>

<hr>

<div class="row m-b-lg m-t-lg">
    <div class="col-md-6">
        <h3 class="m-b-md">Most Submitted To Chapters:</h3>
        @if($user->specialistAreas(3)->isEmpty())
            <p class="italic">{{ $user->name }} has not submitted any content yet.</p>
        @else
            @set('specialistAreas', $user->specialistAreas(3))
            @if($specialistAreas->isEmpty())
                <p class="italic">{{ $user->name }} doesn't have any specialist areas yet :(.</p>
            @else
                @foreach($specialistAreas as $specialistArea)
                    <p><a target="_blank" href="/p/{{ $specialistArea->chapter->category->slug }}/{{ $specialistArea->chapter->slug }}">{{ $specialistArea->chapter->title }} ({{ $specialistArea->total }})</a></p>
                @endforeach
            @endif
        @endif
    </div>

    <div class="col-md-6">
        <h3 class="m-b-md">Community Rank:</h3>

        @set('communityData', $user->getCommunityData())

        <div class="row">
            <div class="col-md-5">
                <p>Ranking</p>
            </div>
            <div class="col-md-6">
                <p><i class="fa fa-trophy"></i> {{ $communityData['rank'] }}</p>
            </div>
            <div class="col-md-5">
                <p>Score</p>
            </div>
            <div class="col-md-6">
                <p><i class="fa fa-star"></i> {{ $communityData['score'] }}</p>
            </div>
            <div class="col-md-5">
                <p>Title</p>
            </div>
            <div class="col-md-6">
                <p><i class="fa fa-star"></i> {{ $communityData['title'] }}</p>
            </div>
        </div>
        <p><a target="_blank" href="http://i.dailymail.co.uk/i/pix/2016/03/08/16/31FE611300000578-3482348-image-a-4_1457453444322.jpg">Cats</a></p>
        <p><a target="_blank" href="https://cdn.pastemagazine.com/www/articles/shakycatmeowmain.jpg">Cats</a></p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3 class="m-b-md">Articles Written:</h3>
        @if($user->pages->isEmpty())
            <p class="italic">{{ $user->name }} has not submitted any new content yet.</p>
        @else
            @foreach($user->pages as $page)
                <p>
                    <a target="_blank" href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->slug }}/{{ $page->slug }}" title="{{ $page->chapter->category->title }} > {{ $page->chapter->title }} > {{ $page->title }}">{{ $page->title }}</a>
                    <small><i class="fa m-l-sm fa-clock-o grey-text"></i> {{ $page->created_at->format('jS M Y, H:i') }}</small>
                </p>
            @endforeach
        @endif
    </div>
    <div class="col-md-6">
        <h3 class="m-b-md">Articles Updated:</h3>
        @if($user->suggestedEdits->isEmpty())
            <p class="italic">{{ $user->name }} has not submitted updates to any content yet.</p>
        @else
            @foreach($user->suggestedEdits as $suggestedEdit)
                <p>
                    <a target="_blank" href="/p/{{ $suggestedEdit->page->chapter->category->slug }}/{{ $suggestedEdit->page->chapter->slug }}/{{ $suggestedEdit->page->slug }}" title="{{ $suggestedEdit->page->chapter->title }} > {{ $suggestedEdit->page->title }}">{{ $suggestedEdit->page->title }}</a>
                    <small><i class="fa m-l-sm fa-clock-o grey-text"></i> {{ $suggestedEdit->created_at->format('jS M Y, H:i') }}</small>
                </p>
            @endforeach
        @endif
    </div>
</div>

@if(session('message'))
    <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
@endif

@stop

@section('scripts')

@stop
