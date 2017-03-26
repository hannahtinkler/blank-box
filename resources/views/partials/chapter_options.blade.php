@if($user->curator || !env('FEATURE_CURATION_ENABLED'))
    <div class="m-t-sm btn-group pull-right page-options">
        <form action="/chapters/{{ $chapter->id }}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" id="delete-chapter-{{ $chapter->id }}" class="btn btn-default">
                <i class="fa fa-trash-o"></i> Delete
            </button>
        </form>
        <a class="btn btn-default" href="/chapters/edit/{{ $chapter->id }}"><i class="fa fa-pencil"></i> Edit</a>
    </div>
@endif
