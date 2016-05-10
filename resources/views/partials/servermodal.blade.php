<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2 class="modal-title" id="myModalLabel">{{ ucwords($server->node_type) }}: {{ $server->name }}</h2>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 m-t-xs">
            <h3>Details</h3>
        </div>
        <div class="col-md-3">
            <strong>Nickname:</strong>
        </div>
        <div class="col-md-9">
            {{ $server->nickname }}
        </div>
        
        <div class="col-md-3">
            <strong>Location:</strong>
        </div>
        <div class="col-md-9">
            {{ $server->location }}
        </div>
        
        <div class="col-md-3">
            <strong>IP Address:</strong>
        </div>
        <div class="col-md-9">
            {{ $server->ip_address }}
        </div>
        
        <div class="col-md-3">
            <strong>Access Type:</strong>
        </div>
        <div class="col-md-9">
            {{ ucwords($server->access_type) }}
        </div>

        <div class="col-md-12 m-t-lg">
            <h3>Port Forwarding <small>
            <a data-toggle="tooltip" class="tooltip-trigger" data-placement="right" title="" data-original-title="You can set up access to this node via any SSH connection by configuring these settings into your SSH port forwarding configuration."><i class="fa fa-question-circle"></i></a>
            </small></h3>
        </div>

        @if($server->portForwardingSettings->isEmpty())
            <div class="col-md-12">
                <p class="italic">There are no forwarding settings for this node.</p>
            </div>
        @else
            @foreach($server->portForwardingSettings as $setting)
                <div class="col-md-4">
                    <strong>{{ $setting->server->ip_address }}:{{ $setting->source_port_number }}</strong>
                </div>
                <div class="col-md-1">
                    =>
                </div>
                <div class="col-md-7">
                    {{ $setting->target_port_number }}
                </div>
            @endforeach
        @endif

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>

<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
</script>
