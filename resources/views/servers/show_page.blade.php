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
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($servers as $server)
            @if(!isset($previousServer) || $previousServer->node_type != $server->node_type)
                <tr class="table-heading">
                    <td colspan="4"><h3>{{ ucwords($server->node_type) }}</h3></td>
                </tr>
            @endif

            <tr id="{{ $server->id }}" {!! $server->id == Request::segment(5) ? ' class="highlight-row"' : null !!}>
                <td>{{ $server->name }}</td>
                <td>{{ ucwords($server->nickname) }}</td>
                <td>{{ ucwords($server->location) }}</td>
                <td class="text-right"><a data-toggle="modal" href="/ajax/modal/server/{{ $server->id }}" data-target="#more-info"><i class="fa fa-plus-square"></i></a></td>
            </tr>

            @set('previousServer', $server)
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-info" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

@stop


@section('scripts')
<script>
    $(document).ready(function() {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
            $('.modal .modal-body').text("Loading...");
        });
     });

    @if(Request::segment(5) != null)
        $(window).load(function() {
            $('#more-info .modal-content').load('/ajax/modal/server/{{ Request::segment(5) }}');
            $('#more-info').modal('show');


            var offset = $('{{ "#" .  Request::segment(5) }}').offset().top - 100;
             $("html,body").animate({scrollTop: offset}, 300);
         });
     @endif
</script>
@stop
