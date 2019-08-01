@extends('layouts.master')

@section('content')

    <h1>{{ $link->page->title }}</h1>
    <h2>{{ $site->name }}</h2>

    <h3 class="m-t-xl m-b-lg">Deployment Log</h3>

    <hr>

    <div class="m-b-xl m-t-xl">
        <pre class="forge-site__log">{!! nl2br($log) !!}</pre>
    </div>
@stop
