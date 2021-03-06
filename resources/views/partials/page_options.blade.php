@if($user->curator || !env('FEATURE_CURATION_ENABLED'))
    <div class="m-t-sm btn-group pull-right page-options">
        @if($page->approved === null)
            <div class="m-t-sm btn-group pull-right">
                <a class="btn btn-default" href="/curation/new/approve/{{ $page->id }}"><i class="fa fa-check"></i> Approve</a>
                <a class="btn btn-default" href="/curation/new/reject/{{ $page->id }}"><i class="fa fa-remove"></i> Reject</a>
            </div>
        @endif
        <form action="/pages/{{ $page->id }}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" id="delete-page-{{ $page->id }}" class="btn btn-default">
                <i class="fa fa-trash-o"></i> Delete
            </button>
        </form>
        <a class="btn btn-default" href="/pages/edit/{{ $page->id }}"><i class="fa fa-pencil"></i> Edit</a>
    </div>
@else
    <div class="m-t-sm btn-group pull-right">
        <a class="btn btn-default" href="/pages/edit/{{ $page->id }}"><i class="fa fa-pencil"></i> Suggest an Edit</a>
    </div>
@endif
