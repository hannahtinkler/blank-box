@extends('layouts.master')

@section('content')
    @if($editable)
        <h1>Edit Page</h1>
    @else
        <h1>Suggest an Edit</h1>
    @endif

    <hr>
    <div class="col-sm-12">
        @if(count($errors) > 0)
            <div class="bg-danger error-message m-b-xl">
                <h4><i class="glyphicon glyphicon-remove"></i> There were some errors:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="row">
        <form role="form" id="new-page-form" action="/pages/{{ $page->id }}" method="POST">
            {!! csrf_field() !!}
            
            {!! method_field('PUT') !!}

            <input type="hidden" name="page_id" value="{{ $page->id }}" />

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Category</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">Select a category...</option>
                        @foreach($categories as $category)
                            <option {!! $category->id == $page->chapter->category->id ? "selected" : null !!} value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Chapter</label>
                    <select name="chapter_id" id="chapter_id" class="form-control">
                    <option>Select a chapter...</option>
                        @foreach($chapters as $chapter)
                            <option {!! $chapter->id == $page->chapter->id ? "selected" : null !!} value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Page Title</label>
                    <input class="form-control" value="{{ old('title') ? old('title') : $page->title }}" name="title" id="title" />
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Page Description</label>
                    <textarea class="form-control" name="description" id="description">{{ old('description') ? old('description') : $page->description }}</textarea>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group m-b-xs">
                    <label>Content</label>
                    <textarea class="form-control" name="content" id="textboxCkeditor">{{ old('content') ? old('content') : $page->content }}</textarea>
                </div>
            </div>

            <input type="hidden" id="last-draft-id" name="last_draft_id" value="">

            <div class="col-sm-12 m-t-md m-b-xl">
                <!-- IF is a curator -->
                <!-- <input class="form-group" type="checkbox" value="true" /> Publish this page -->
                <!-- END IF -->

                <div class="btn-toolbar pull-right">
                    <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Submit for Review</strong></button></div>
                </div>
            </div>
        </form>
    </div>

@stop

@section('scripts')

<script>
    $(document).ready(function () {
        CKEDITOR.replace('textboxCkeditor');
        CKEDITOR.config.height = 500;


        $('#category_id').change(function() {
            getChapters();
        });


        function getChapters() {
            var categoryId = $('#category_id').val();

            if (categoryId == '') {
                $('#chapter_id').html('');
                $('#chapter_id').attr('disabled', true);
            } else {
                $.get('/ajax/data/chapters/' + categoryId, function(data) {
                    data = JSON.parse(data);
                    $('#chapter_id').html('');
                    $('#chapter_id').append('<option value="">Select a category...</option>');
                    $.each(data, function(key, value) {
                        $('#chapter_id').append('<option id="opt' + value.id + '" value="' + value.id + '">' + value.title + '</option>');
                    });
                    $('#chapter_id').attr('disabled', false);
                    @if(old('chapter_id'))
                        $('option#opt{{ old("chapter_id") }}').attr('selected', true);
                    @endif
                }).fail(function() {
                    alert( "There was an error processing this request :(" );
                });
            }
        }
    });
</script>

@stop
