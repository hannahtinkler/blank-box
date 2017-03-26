<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2 class="modal-title text-center" id="myModalLabel">{{ $badge->type->name }}</h2>
</div>
<div class="modal-body text-center">
    <h3>{{ $badge->name }}</h3>
    <h4>Level {{ $badge->level }}</h4>

    <img class="large-badge {!! !$earned ? 'not-earned' : null !!}" src="{{ $badge->image }}" />

    <p class="m-t-lg">
    	{{ $badge->description }}<br />
    	<small class="italic">
	    	@if($earned)
	    		Earned on {{ $badge->created_at->format('jS M Y, H:ia')}}
			@else
				Not yet earned
	    	@endif
    	</small>
	</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
