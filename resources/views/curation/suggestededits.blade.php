@extends('layouts.master')

@section('content')

    <h1>Curation</h1>
    <h2>Suggested Edits Awaiting Approval</h2>

    <hr>

    @if(session('message'))
        <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
    @endif

    <div class="wrapper wrapper-content animated blog">
    <div class="row">
        @if($edits->isEmpty())
            There are no edits to curate right now. Go do some real work.
        @else
            @foreach($edits as $edit)
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12">
                                <a target="_blank" href="/curation/viewdiff/{{ $edit->id }}">
                                    <h2>
                                        {{ $edit->title }}
                                    </h2>
                                </a>
                                <div class="small m-b-sm">
                                    Suggested by <strong><a href="/u/{{ $edit->creator->slug }}">{{ $edit->creator->name }}</a></strong> <span class="text-muted"><i class="fa fa-clock-o"></i> {{ $edit->created_at->format('jS M Y') }}</span>
                                </div>
                                <p>
                                    {{ $edit->description }}
                                </p>
                                <div class="row">
                                    <div class="col-md-6 m-t-sm">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-book"> </i> {{ $edit->chapter->category->title }}</button>
                                        <button class="btn btn-white btn-xs" type="button"><i class="fa fa-folder-o"> </i> {{ $edit->chapter->title }}</button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-right">
                                        </div>
                                    </div>
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
<script>
    $(document).ready(function() {
        $('.approve-button').each(function() {
            var width = $(this).parent().parent().parent().height();
            var fontsize = width / 2.5;
            var height =  (width - fontsize - 5) /2;
            $(this).css('font-size', fontsize);
            $(this).css('padding-top', height);
            $(this).css('padding-bottom', height);
            $(this).width($(this).innerHeight() - 25);
        });
    });
</script>
@stop
