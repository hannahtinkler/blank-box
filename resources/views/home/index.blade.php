@extends('layouts.master')

@section('content')

<h1><?php echo config('global.site-name'); ?></h1>

<hr>

<div class="row">
    <div class="col-md-12">
        <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">

            <div class="all-comments">

                @foreach($feedEvents as $feedEvent)
                    @if($feedEvent->resourceExists())
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                @if($feedEvent->type->name == 'Page Added')
                                    <div class="icon-circle">{!! $feedEvent->getImage() !!}</div>
                                @else
                                    {!! $feedEvent->getImage() !!}                                
                                @endif
                            </div>

                            <div class="vertical-timeline-content">
                                    <h4>{!! $feedEvent->getText() !!}</h4>
                                <span class="vertical-date">
                                    <small>{{ $feedEvent->created_at->format('jS M Y') }}</small><br />
                                    <small>{{ $feedEvent->created_at->format('H:i') }}</small>
                                </span>
                            </div>
                        </div>
                    @endif
                @endforeach
            
            </div>
        </div>
    </div>
</div>

@stop


@section('scripts')
@stop
