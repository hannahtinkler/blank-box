@extends('layouts.master')

@section('content')

<h1><?php echo env('APP_NAME', 'Black Box'); ?></h1>

<hr>

<div class="row">
    <div class="col-md-12">
        <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">

            <div class="all-comments">

                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon navy-bg">
                        <div class="icon-circle"><i class="feed-icon fa fa-exclamation"></i></div>
                    </div>

                    <div class="vertical-timeline-content">
                        @if(env('APP_NAME') == 'Glass Box')
                            <h4><strong>Black Box:</strong></h4>
                            <p><a href="http://black-box.mayden.co.uk/">The developer specific Black Box can now be found here!</a></p>
                        @else
                            <h4><strong>Glass Box:</strong></h4>
                            <p><a href="http://amt.mayden.co.uk/">The generic company Glass Box can be found here</a></p>
                        @endif
                        <span class="vertical-date">
                            <small>{{ date('jS M Y') }}</small><br />
                            <small>{{ date('H:i') }}</small>
                        </span>
                    </div>
                </div>

                @if(date('Y-m-d') < '2017-12-24' && env('APP_NAME') == 'Black Box')
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <div class="icon-circle"><i class="feed-icon fa fa-exclamation"></i></div>
                        </div>

                        <div class="vertical-timeline-content">
                            <h4><strong>Super Very Important News:</strong></h4>
                            <p>Only {{ $daysTilXmas }} Days Until Christmas!</p>
                            <span class="vertical-date">
                                <small>{{ date('jS M Y') }}</small><br />
                                <small>{{ date('H:i') }}</small>
                            </span>
                        </div>
                    </div>
                @endif

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
