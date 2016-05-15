@extends('layouts.master')

@section('content')


<h1>Latest Updated Pages:</h1>
    
<div class="wrapper wrapper-content  animated fadeInRight blog">
    <div class="row">
        @foreach($updatedPages as $page)
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="/p/{{ $page->chapter->category->slug }}/{{ $page->chapter->slug }}/{{ $page->slug }}">
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
                </div>
            </div>
        @endforeach
        </div>
    </div>

    {!! $updatedPages->links() !!}
    
</ul>

@stop

@section('scripts')

@stop