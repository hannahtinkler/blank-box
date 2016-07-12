@extends('layouts.master')

@section('content')

    <h1>Curation</h1>
    <h2>New Pages Awaiting Approval</h2>

    <hr>

    <div class="wrapper wrapper-content animated blog">
    <div class="row">
        @if($pages->isEmpty())
            There are no new pages to curate right now. Go do some real work.
        @else
            @foreach($pages as $page)
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-10">
                                    <a target="_blank" href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->slug }}/{{ $page->slug }}">
                                        <h2>
                                            {{ $page->title }}
                                        </h2>
                                    </a>
                                    <div class="small m-b-sm">
                                        <strong>{{ $page->creator->name }}</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 28th Oct 2015</span>
                                    </div>
                                    <p>
                                        {{ $page->description }}
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 m-t-sm">
                                            <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-book"> </i> {{ $page->chapter->category->title }}</button>
                                            <button class="btn btn-white btn-xs" type="button"><i class="fa fa-folder-o"> </i> {{ $page->chapter->title }}</button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-right">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="/curation/view/{{ $page->id }}" class="btn btn-xs btn-primary approve-link"><span id="view-button" class="view-button fa fa-search"></span></a>
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
        $('.view-button').each(function() {
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
