@if($page->created_by == $user->id || $user->curator)
    <form action="/page/{{ $page->id }}" method="POST">
        <div class="m-t-sm btn-group pull-right">
            <a class="btn btn-default" href="/page/edit/{{ $page->id }}"><i class="fa fa-pencil"></i> Edit</a>
        
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" id="delete-page-{{ $page->id }}" class="btn btn-default">
                <i class="fa fa-btn fa-trash-o"></i> Delete
            </button>
        </div>
    </form>
@endif
<div class="m-t-sm btn-group pull-right m-r-sm">
    <a class="btn btn-default" href="/page/suggest/{{ $page->id }}"><i class="fa fa-commenting-o"></i> Suggest</a>
</div>
