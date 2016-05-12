<button class="btn btn-default"><a href="/page/edit/{{ $page->id }}">Edit</a></button>
<form action="/page/{{ $page->id }}" method="POST">
    {!! csrf_field() !!}
    {!! method_field('DELETE') !!}
    <button type="submit" id="delete-page-{{ $page->id }}" class="btn btn-default">
        <i class="fa fa-btn fa-trash"></i> Delete
    </button>
</form>