@if($page->created_by == $user->id || $user->curator)
    <div class="btn-group pull-right">
        <a class="btn btn-default" href="/page/edit/{{ $page->id }}">Edit</a>
        <a class="btn btn-default" href="">Delete</a>
    </div>
@endif
