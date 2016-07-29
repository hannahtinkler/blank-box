@extends('layouts.master')

@section('content')

    <h1>Your Badges</h1>

    <hr>

    @if(session('message'))
        <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
    @endif

    <div class="wrapper wrapper-content animated blog">
    <div class="row">
        @if(empty($userBadges))
            This user has no badges yet :(
        @else
            @foreach($badgeGroups as $badgeGroup)
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>
                                        {{ $badgeGroup->name }}
                                    </h2>
                                    <p>
                                        {{ $badgeGroup->description }}
                                    </p>
                                    @foreach($badgeGroup->badges as $badge)
                                        <div class="badge-image left">
                                            <img src="http://www.languagenut.com/assets/media/placeholders/250x250-circle.png" />
                                            <p>{{ $badge->name }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>

@stop

@section('scripts')
