@extends('layouts.master')

@section('content')

    <h1>Your Drafts</h1>

    <hr>

    @if(session('message'))
        <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
    @endif

    <div class="wrapper wrapper-content animated blog">
    <div class="row">
        @if($drafts->isEmpty())
            <div class="col-lg-12">
                Looks like you don't have any drafts saved. 
            </div>
        @else
            @foreach($drafts as $draft)
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h2>
                                <a target="_blank" href="/pagedrafts/{{ $draft->id }}">
                                    {!! $draft->title != '' ? $draft->title : '<span class="italic">Not Yet Titled</span>' !!}
                                </a>

                                <button class="btn btn-primary btn-xs m-l-lg" type="button"><i class="fa fa-book"> </i> {!! $draft->chapter->category->title or '<span class="italic">None yet</span>' !!}</button>
                                <button class="btn btn-white btn-xs" type="button"><i class="fa fa-folder-o"> </i> {!! $draft->chapter->title or '<span class="italic">None yet</span>' !!}</button>
                            </h2>
                            <div class="small m-b-sm">
                                <strong><a href="/u/{{ $draft->creator->slug }}">{{ $draft->creator->name }}</a></strong> <span class="text-muted"><i class="fa fa-clock-o"></i> {{ $draft->created_at->format('jS M Y, H:i:s') }}</span>
                            </div>
                            <p>
                                {{ $draft->description }}
                            </p>
                            <div class="row">
                                <div class="col-md-12 m-t-md">
                                    <a title="Delete this draft" class="btn btn-xs btn-info" href="/pagedrafts/delete/{{ $draft->id }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a class="btn btn-xs btn-info" target="_blank" href="/pagedrafts/{{ $draft->id }}">
                                        &#9654; Continue editing
                                    </a>
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
