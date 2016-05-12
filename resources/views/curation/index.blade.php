@extends('layouts.master')

@section('content')

    <h1>Curation Page</h1>
    <h2>Pages awaiting approval</h2>

    <hr>

    <div class="list-group">
        @foreach($pages as $page)
            <!-- this looks awful change it -->
            <div class="col-md-10">
                <a href="#" class="list-group-item clearfix">
                    <span class="fa fa-page"></span>
                    {{ $page->description }}
                    <span class="pull-right">
                  <p class="btn btn-xs btn-info">{{ date('jS F Y H:i', strtotime($page->created_at)) }}</p>
                </span>
                </a>
            </div>
            <div class="col-md-2">
                <a href="/curation/approve/{{ $page->id }}" class="btn btn-xs btn-primary"><span id="approve-button" class="fa fa-check"></span></a>
            </div>
        @endforeach

    </div>

@stop

@section('scripts')

@stop
