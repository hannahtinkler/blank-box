@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter_id != NULL ? $page->chapter->category->title : 'No Category Yet' }} - {{ $page->chapter_id != NULL ? $page->chapter->title : 'No Chapter Yet' }}</h1>
<h2>{{ $page->title != NULL ? $page->title : 'No Title Yet' }}</h2>

<hr>

{!! html_entity_decode($page->content) !!}

<div class="btn-toolbar pull-right m-t-xl">
    <div class="btn-group"><button class="btn btn-primary" id="close-preview"><strong>Close Preview</strong></button></div>
</div>

@stop


@section('scripts')
<script>
    $(document).ready(function () {
        $('#close-preview').click(function() {
            window.close();
        });
    });
</script>
@stop
