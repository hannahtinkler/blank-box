@extends('layouts.master')

@section('content')

    <h1>{{ $site->name}}</h1>
    <h2>Deployment Log</h2>

    <div class="m-b-xl m-t-xl">
        <pre>{!! nl2br($log) !!}</pre>
    </div>
@stop
