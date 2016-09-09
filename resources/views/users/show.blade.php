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
        @if($user->specialistAreas(4)->isEmpty())
            <p class="italic">{{ $user->name }} has not submitted any content yet.</p>
        @else
            @set('specialistAreas', $user->specialistAreas(4))
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
        <h3 class="m-b-md">Community: <small><i class="m-l-sm pointer fa fa-info-circle" title="Community ranks/scores are based on the quantity of
information a person has contributed to <?php echo config('global.site-name'); ?>"></i></small></h3>

        @set('communityData', $user->getCommunityData())

        <div class="row">
            <div class="col-md-4">
                <p>Ranking:</p>
            </div>
            <div class="col-md-7">
                <a href="/rankings"><p><i class="fa fa-trophy"></i> {{ $communityData['rank'] }}</p></a>
            </div>
            <div class="col-md-4">
                <p>Score:</p>
            </div>
            <div class="col-md-7">
                <p><i class="fa fa-star"></i> {{ $communityData['score'] }}</p>
            </div>
            @if (config('global.badges_enabled'))
                <div class="col-md-4">
                    <p>Badges:</p>
                </div>
                <div class="col-md-7">
                    <a href="/u/{{ $user->slug }}/badges">
                        <p><i class="fa fa-shield"></i> {{ $communityData['badgeCount'] }}</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <p>Best Badge:</p>
                </div>
                <div class="col-md-7">
                    <a href="/u/{{ $user->slug }}/badges">
                        {{ $communityData['bestBadge'] == null ? 'None earned yet' : $communityData['bestBadge'] }}</p>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3 class="m-b-md">Recent Pages:</h3>
        @if($user->pages->isEmpty())
            <p class="italic">{{ $user->name }} has not submitted any new content yet.</p>
        @else
            @foreach($user->pages->take(15) as $page)
                <p>
                    <a target="_blank" href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->slug }}/{{ $page->slug }}" title="{{ $page->chapter->category->title }} > {{ $page->chapter->title }} > {{ $page->title }}">{{ $page->title }}</a>
                    <small><i class="fa m-l-sm fa-clock-o grey-text"></i> {{ $page->created_at->format('jS M Y, H:i') }}</small>
                </p>
            @endforeach
        @endif
    </div>
    <div class="col-md-6">
        <h3 class="m-b-md">Recent Page Updates:</h3>
        @if($user->suggestedEdits->isEmpty())
            <p class="italic">{{ $user->name }} has not submitted updates to any content yet.</p>
        @else
            @foreach($user->suggestedEdits->take(15) as $suggestedEdit)
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
