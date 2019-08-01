@extends('layouts.master')

@section('content')

    <h1>{{ $link->page->title }}</h1>
    <h2>{{ $site->name }}</h2>

    <h4 class="m-t-xl m-b-lg">Deployment Script</h4>

    <hr>

    <div class="m-t-xl">
        <div class="m-b-xl m-t-xl">
            <pre class="forge-site__log">{!! nl2br($script) !!}</pre>
        </div>
    </div>
@stop
