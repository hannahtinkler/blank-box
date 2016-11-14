@extends('layouts.master')

@section('content')

<h1><?php echo env('APP_NAME', 'Black Box'); ?></h1>

<hr>

<div class="row">
    <div class="col-md-12">
        <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">

            <div class="all-comments">

                @if(date('Y-m-d') < '2016-12-24')
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

                @if(date('Y-m-d') < '2016-12-14')
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <div class="icon-circle"><i class="feed-icon fa fa-gift"></i></div>
                        </div>

                        <div class="vertical-timeline-content">
                            <h4><strong>New updates to Black Box:</strong></h4>
                            <ul>
                                <li>Text editor replaced with Markdown editor</li>
                                <li>Page drafts now visible to anyone</li>
                                <li>Code block syntax highlighting</li>
                                <li>Code block 'Copy' button</li>
                            </ul>
                            <span class="vertical-date">
                                <small>14th Nov 2016</small><br />
                                <small>17:11</small>
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
