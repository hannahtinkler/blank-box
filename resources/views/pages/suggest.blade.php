@extends('layouts.master')

@section('content')
    <h1>Suggested an Edit</h1>
    <h2>{{ $page->title }}</h2>

    <hr>

    @if(session('message'))
        <p class="bg-success error-message"><i class="glyphicon glyphicon-check"></i> {!! session('message') !!}</p>
    @endif

    <div class="row">
        <form role="form" id="new-page-form" action="/page/suggest/{{ $page->id }}/save" method="POST">
            {!! csrf_field() !!}
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Category </label> <br />
                    @foreach($categories as $category)
                        {!! $category->id == $page->chapter->category->id ? $category->title : null !!}
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Chapter </label><br />
                    @foreach($chapters as $chapter)
                        {!! $chapter->id == $page->chapter->id ? $chapter->title : null !!}
                    @endforeach
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Page Title </label><br /> {{ $page->title }}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Page Description </label> <br /> {{ $page->description }}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group m-b-xs">
                    <label>Current Content</label><br />
                    <div class="page-content">{!! $page->content !!}</div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                    <br />
                    <label>Suggestion</label><br />
                    <textarea class="form-control" name="suggestion" id="suggestion"></textarea>
                </div>
            </div>
            
            <input type="hidden" name='page_id' id='page_id' value='{{$page->id}}' />

            <div class="col-sm-12 m-t-md m-b-xl">
                <!-- IF is a curator -->
                <!-- <input class="form-group" type="checkbox" value="true" /> Publish this page -->
                <!-- END IF -->

                <div class="btn-toolbar pull-right">
                    <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Submit Comment</strong></button></div>
                </div>
            </div>
        </form>
    </div>

@stop

@section('scripts')

@stop
