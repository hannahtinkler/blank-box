@extends('layouts.master')

@section('content')


<h1>Latest Updated Pages:</h1>
    
<div class="row">
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @foreach($updatedPages as $page)
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <a target="_blank" href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->slug }}/{{ $page->slug }}">
                            <h2>
                                {{ $page->title }}
                            </h2>
                        </a>
                        <div class="small m-b-sm">
                            <strong><a href="/u/{{ $page->creator->slug }}">{{ $page->creator->name }}</a></strong> <span class="text-muted"><i class="fa fa-clock-o"></i> {{ $page->created_at->format('jS M Y') }}</span>
                        </div>
                        <p>
                            {{ $page->description }}
                        </p>
                        <div class="row">
                            <div class="col-md-6 m-t-sm">
                                    <a class="btn btn-primary btn-xs" target="_blank" href="/p/{{ $page->chapter->category->slug }}"><i class="fa fa-book"> </i> {{ $page->chapter->category->title }}</a>
                                    <a class="btn btn-white btn-xs" target="_blank" href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->title }}"><i class="fa fa-folder-o"> </i> {{ $page->chapter->title }}</a>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {!! $updatedPages->links() !!}
</div>

    
</ul>

@stop

@section('scripts')
@stop
