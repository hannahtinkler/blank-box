@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->title }}</h1>
<h2>{{ $page->title }}</h2>

<hr>

<table class="table table-striped table-bordered table-hover dataTables-example m-t-xl">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Service Name</th>
            <th>Area</th>
            <th>Type</th>
            <th>Server</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
            <tr id="{{ $service->id }}" {!! $service->id == Request::segment(5) ? ' class="highlight-row"' : null !!}>
                <td>
                    @if($service->live_site_url)
                        <a target="_blank" href="https://{{ $service->live_site_url }}:8443"><i class="fa fa-share-square-o"></i></a>
                    @endif
                </td>
                <td>{{ $service->service_id }}</td>
                <td>
                    {{ ucwords($service->name) }}
                </td>
                <td>{{ ucwords($service->area) }}</td>
                <td>{{ ucwords($service->type) }}</td>
                <td><a data-toggle="modal" href="/ajax/modal/server/{{ $service->server->id }}" data-target="#more-info">{{ $service->server->name }} ({{ $service->server->nickname }})</a></td>
            </tr>
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
            var offset = $('{{ "#" . Request::segment(5) }}').offset().top - 100;
             $("html,body").animate({scrollTop: offset}, 300);
        });
     @endif
</script>
@stop
