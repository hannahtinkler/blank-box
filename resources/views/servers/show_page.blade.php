@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->title }}</h1>
<h2>{{ $page->title }}</h2>

<hr>

<table class="table table-striped table-bordered table-hover dataTables-example m-t-xl">
    <thead>
        <tr>
            <th>Server Name</th>
            <th>Nickname</th>
            <th>Location</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($servers as $server)
            <tr id="{{ $server->id }}" {!! $server->id == Request::segment(5) ? ' class="highlight-row"' : null !!}>
                <td>{{ $server->name }}</td>
                <td>{{ ucwords($server->nickname) }}</td>
                <td>{{ ucwords($server->location) }}</td>
                <td>{{ ucwords($server->type) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop


@section('scripts')
<script>
    $(window).load(function() {
        if(window.location.hash) {
            var offset = $('{{ "#" .  Request::segment(5) }}').offset().top - 100;
             $("html,body").animate({scrollTop: offset}, 300);
         }
    });
</script>
@stop
