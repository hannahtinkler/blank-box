@extends('layouts.master')

@section('content')

<h1>Black Box</h1>

<hr>

<div class="row">
    <div class="col-md-12">
        <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">

            <div class="all-comments">

                @foreach($feedEvents as $feedEvent)
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <a href="/u/{{ $feedEvent->user->slug }}">
                                {!! $feedEvent->getImage() !!}                                
                            </a>
                        </div>

                        <div class="vertical-timeline-content">
                                <h4>{!! $feedEvent->getText() !!}</h4>
                            <span class="vertical-date">
                                <small>{{ $feedEvent->created_at->format('jS M Y') }}</small><br />
                                <small>{{ $feedEvent->created_at->format('H:i') }}</small>
                            </span>
                        </div>
                    </div>
                @endforeach
            
            </div>
        </div>
    </div>
</div>

@stop


@section('scripts')
@stop
