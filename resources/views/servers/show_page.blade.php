@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->title }}</h1>
<h2>{{ $page->title }}</h2>

<hr>

<table>
    <thead>
        <tr>
            <td>Server Name</td>
            <td>Nickname</td>
            <td>Location</td>
            <td>Node</td>
            <td>Type</td>
        </tr>
    </thead>
    <tbody>
        @foreach($servers as $server)
            <tr id="{{ $server->id }}" {!! $server->id == Request::segment(4) ? ' class="highlight-row"' : null !!}>
                <td>{{ ucwords($server->name) }}</td>
                <td>{{ ucwords($server->nickname) }}</td>
                <td>{{ ucwords($server->location) }}</td>
                <td>{{ ucwords($server->node_number) }}</td>
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
            var offset = $('{{ "#" . Request::segment(4) }}').offset().top - 100;
             $("html,body").animate({scrollTop: offset}, 300);
         }
    });
</script>
@stop
