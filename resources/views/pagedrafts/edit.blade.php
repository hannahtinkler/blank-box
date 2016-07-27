@extends('layouts.master')

@section('content')

<h1>Edit Your Draft</h1>

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

<form role="form" id="edit-draft-form" action="/u/{{ $user->slug }}/drafts/{{ $draft->id }}" method="POST">
    {!! csrf_field() !!}

    <input type="hidden" name="page_id" value="{{ $draft->page_id }}" />
    <input type="hidden" id="last-draft-id" name="last_draft_id" value="{{ $draft->id }}">

    <div class="col-sm-6">
        <div class="form-group">
            <label>Category</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">Select a category...</option>
                @foreach($categories as $category)
                    <option {!! $draft->chapter_id != null ? ($category->id == $draft->chapter->category->id ? "selected" : null) : null  !!} value="{{ $category->id }}">{{ $category->title }}</option>
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
                    <option {!! $draft->chapter_id != null ? ($chapter->id == $draft->chapter->id ? "selected" : null) : null !!} value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Page Title</label>
            <input class="form-control" value="{{ $draft->title == '' ? $draft->title : $draft->title }}" name="title" id="title" />
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Page Description</label>
            <textarea class="form-control" name="description" id="description">{{ $draft->description == '' ? $draft->description : $draft->description }}</textarea>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group m-b-xs">
            <label>Content</label>
            <textarea class="form-control" name="content" id="textboxCkeditor">{{ $draft->content == '' ? $draft->content : $draft->content }}</textarea>
        </div>
        <small class="italic help-block last-saved pull-right m-b-lg">Not yet saved</small>
    </div>

    <input type="hidden" id="last-draft-id" name="last_draft_id" value="">

    <div class="col-sm-12 m-t-md m-b-xl">
        <!-- IF is a curator -->
        <!-- <input class="form-group" type="checkbox" value="true" /> Publish this page -->
        <!-- END IF -->

        <div class="btn-toolbar pull-right">
            <div class="btn-group"><a class="btn btn-sm btn-default m-t-n-xs save-as-draft"><strong>Save as Draft</strong></a></div>
            <div class="btn-group"><a class="btn btn-sm btn-default m-t-n-xs preview-page"><strong>Preview</strong></a></div>
            <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Submit for Review</strong></button></div>
        </div>
    </div>
</form>

@stop


@section('scripts')
<script>
    $(document).ready(function () {
        var currentDraft = parseInt($('#last-draft-id').val());

        CKEDITOR.replace('textboxCkeditor');
        CKEDITOR.config.height = 500;

        if ($('#category_id').val() != '') {
           getChapters();
        }

        $('#category_id').change(function() {
           getChapters();
        });

        $('.preview-page').click(function() {
            data = getFormContent();

            $.post(getPostUrl(), getFormContent(), function(savedDraft) {
                savedDraft = JSON.parse(savedDraft);
                currentDraft = savedDraft.draft.id;
                $('.last-saved').text('Last saved: ' + savedDraft.draft.updated_at_formatted);
                openInNewTab();
            }).fail(function() {
                alert( "There was an error processing this request :(" );
            });
        });

        $('.save-as-draft').click(function() {
            saveDraft();
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
                    @if($draft->chapter_id != null)
                        $('option#opt{{ $draft->chapter_id }}').attr('selected', true);
                    @endif

                }).fail(function() {
                    alert( "There was an error processing this request :(" );
                });
            }
        }

        function saveDraft() {
            data = getFormContent();
            triggerSaveDraftButtonChange();

            $.post(getPostUrl(), getFormContent(), function(savedDraft) {
                savedDraft = JSON.parse(savedDraft);
                currentDraft = savedDraft.draft.id;
                $('.last-saved').text('Last saved: ' + savedDraft.draft.updated_at_formatted);
                $('#last-draft-id').val(currentDraft);
                $('#draft-count').html(savedDraft.count);
            }).fail(function() {
                alert( "There was an error processing this request :(" );
            });
        }

        function openInNewTab() {
            var newTab = window.open('/u/{{ $user->slug }}/drafts/preview/' + currentDraft, '_blank');
            newTab.focus();
        }

        function getFormContent() {
            $('#textboxCkeditor').text(CKEDITOR.instances.textboxCkeditor.getData());
            return $('#edit-draft-form').serializeArray();
        }

        function getPostUrl() {
            return "/u/{{ $user->slug }}/drafts" + (typeof currentDraft == 'number' ? '/' + currentDraft : '');
        }

        function triggerSaveDraftButtonChange() {
            $('.save-as-draft').attr('disabled', true);
            $('.save-as-draft').width($('.save-as-draft').width());
            $('.save-as-draft').html('<strong><i class="fa fa-check"></i> Saved</strong>');
            setTimeout(function(){
                $('.save-as-draft').html('<strong>Save as Draft</strong>');
                $('.save-as-draft').attr('disabled', false);
            }, 1000);
        }

        setInterval(saveDraft, 60000);
    });
</script>
@stop
