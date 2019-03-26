@extends('layouts.master')

@section('content')

<h1>Create New Page</h1>

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

<form role="form" id="new-page-form" action="/pages" method="POST">
    {!! csrf_field() !!}
    <div class="col-sm-6">
        <div class="form-group">
            <label>Category</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">Select a category...</option>
                @foreach($categories as $category)
                    <option {!! $category->id == old('category_id') ? "selected" : null !!} value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Chapter</label>
            <select name="chapter_id" disabled="true" id="chapter_id" class="form-control">
            </select>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Page Title</label>
            <input class="form-control" value="{{ old('title') }}" name="title" id="title" />
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Page Description</label>
            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group m-b-xs">
            <label>Content</label>
            <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
        </div>

        <div class="m-b-xl">
            <label>
                <input type="checkbox" name="has_resources" value="1" {{ old('has_resources') ? 'checked="true"' : '' }}"/>
                Enable resources for this page
            </label>
            <small class="italic help-block last-saved pull-right m-b-sm">Not yet saved</small>
        </div>
    </div>

    <!-- <div class="col-sm-12 m-b-lg">
        <div class="form-group">
            <label>Tags <span class="italic">(comma separated)</span> <i class="fa fa-question-circle pointer" title="These tags will be used to suggest help pages for Orbit tasks based on task title"></i></label>
            <select id="tag-select" name="tags[]" multiple="multiple">
                @foreach($tags as $tag)
                    <option value="{{ $tag->tag }}">{{ $tag->tag }}</option>
                @endforeach
            </select>
        </div>
    </div> -->

    <input type="hidden" id="last-draft-id" name="last_draft_id" value="">

    <div class="col-sm-12 m-t-md m-b-xl">
        <!-- IF is a curator -->
        <!-- <input class="form-group" type="checkbox" value="true" /> Publish this page -->
        <!-- END IF -->

        <div class="btn-toolbar pull-right">
            <div class="btn-group"><a class="btn btn-sm btn-default m-t-n-xs save-as-draft"><strong>Save as Draft</strong></a></div>
            <div class="btn-group"><a class="btn btn-sm btn-default m-t-n-xs preview-page"><strong>Preview</strong></a></div>

            <div class="btn-group">
                <button class="btn btn-sm btn-primary m-t-n-xs" type="submit">
                    @if (!env('FEATURE_CURATION_ENABLED'))
                        <strong>Submit</strong>
                    @else
                        <strong>Submit for Review</strong>
                    @endif
                </button>
            </div>
        </div>
    </div>
</form>

@stop


@section('scripts')
<script>
    var simpleMde = getSimpleMde(document.getElementById('content'))

    $('#tag-select').select2({
        tags: true,
        tokenSeparators: [','],
        minimumInputLength: 1
    });

    $(document).ready(function () {
        var currentDraft;

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
                console.log( "There was an error processing this request :(" );
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
                    @if(old('chapter_id'))
                        $('option#opt{{ old("chapter_id") }}').attr('selected', true);
                    @endif
                }).fail(function() {
                    console.log( "There was an error processing this request :(" );
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

                var currentDraftCount = parseInt($('#draft-count span').html());
                $('#draft-count span').html(savedDraft.count);
                $('#draft-count').removeClass('hidden');

                var currentYourCount = parseInt($('#your-count span').html());
                $('#your-count span').html(currentYourCount + (savedDraft.count - currentDraftCount));
                $('#your-count').removeClass('hidden');
            }).fail(function() {
                console.log( "There was an error processing this request :(" );
            });
        }

        function openInNewTab() {
            var newTab = window.open('/u/{{ $user->slug }}/drafts/preview/' + currentDraft, '_blank');
            newTab.focus();
        }

        function getFormContent() {
            $('#content').text(simpleMde.value());
            return $('#new-page-form').serializeArray();
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
