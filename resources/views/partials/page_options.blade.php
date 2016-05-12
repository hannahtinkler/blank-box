@if($page->created_by == $user->id || $user->curator)
    <form action="/page/{{ $page->id }}" method="POST">
        <div class="btn-group pull-right">
            <a class="btn btn-default" href="/page/edit/{{ $page->id }}"><i class="fa fa-pencil"></i> Edit</a>
        
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" id="delete-page-{{ $page->id }}" class="btn btn-default">
                <i class="fa fa-btn fa-trash"></i> Delete
            </button>
        </div>
    </form>
@endif
<div class="btn-group pull-right">
    <a class="btn btn-default" href="/page/comment/{{ $page->id }}"><i class="fa fa-pencil"></i>Comment</a>
</div>
