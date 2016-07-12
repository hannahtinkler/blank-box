@extends('layouts.master')

@section('content')

    <h1>Curation</h1>
    <div class="m-t-sm btn-group pull-right">
        <a class="btn btn-default" href="/curation/edits/approve/{{ $edit->id }}"><i class="fa fa-check"></i> Approve</a>
        <a class="btn btn-default" href="/curation/edits/reject/{{ $edit->id }}"><i class="fa fa-remove"></i> Reject</a>
    </div>
    <h2>View Suggested Edit</h2>

    <hr>

@if(session('message'))
    <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
@endif

<div class="diff-container m-t-xl">
    <h2>{!! html_entity_decode($diff['category']) !!} - {!! html_entity_decode($diff['chapter']) !!}</h2>
    <h3 class="m-b-lg">
        {!! html_entity_decode($diff['title']) !!}
    </h3>

    {!! html_entity_decode($diff['description']) !!}

    <hr class="m-t-lg">

    {!! html_entity_decode($diff['content']) !!}
</div>


@stop

@section('scripts')

@stop
