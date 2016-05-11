@extends('layouts.master')

@section('content')

<h1>Create New Page</h1>

<hr>
<div class="col-sm-12">
    @if(session('errorMessages'))
        <div class="bg-danger error-message m-b-xl">
            <h4><i class="glyphicon glyphicon-remove"></i> There were some errors:</h4>
            <ul>
                @foreach(session('errorMessages') as $message)
                    <li>{!! $message[0] !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<form role="form" id="new-page-form" action="/page/save" method="POST">
    {!! csrf_field() !!}
    <div class="col-sm-6">
        <div class="form-group">
            <label>Category</label> 
            <select name="category_id" id="category_id" class="form-control">
                <option>Select a category...</option>
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
            <textarea class="form-control" name="content" id="textboxCkeditor">{{ old('content') }}</textarea>
        </div>
        <small class="italic help-block last-saved pull-right m-b-lg">Not yet saved</small>
    </div>

    <div class="col-sm-12 m-t-md m-b-xl">
        <!-- IF is a curator -->
        <!-- <input class="form-group" type="checkbox" value="true" /> Publish this page -->
        <!-- END IF -->

        <div class="btn-toolbar pull-right">
            <div class="btn-group"><a class="btn btn-sm btn-default m-t-n-xs save-as-draft"><strong>Save as Draft</strong></a></div>
            <div class="btn-group"><a class="btn btn-sm btn-default m-t-n-xs preview-page"><strong>Preview</strong></a></div>
            <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Submit for Curation</strong></button></div>
        </div>
    </div>
</form>

@stop


@section('scripts')
<script>
    $(document).ready(function () {
        var currentDraft;

        CKEDITOR.replace('textboxCkeditor');
        CKEDITOR.config.height = 500;

        if ($('#category_id').val() != '' && $('#category_id').val() != 'Select a category...') {
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

            if (categoryId == '' || categoryId == 'Select a category...') {
                $('#chapter_id').html('');
                $('#chapter_id').attr('disabled', true);
            } else {
                $.get('/ajax/data/chapters/' + categoryId, function(data) {
                    data = JSON.parse(data);
                    $('#chapter_id').append('<option value="2">Select a category...</option>');
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

        function saveDraft() {
            data = getFormContent();
            triggerSaveDraftButtonChange();

            $.post(getPostUrl(), getFormContent(), function(savedDraft) {
                savedDraft = JSON.parse(savedDraft);
                currentDraft = savedDraft.draft.id;
                $('.last-saved').text('Last saved: ' + savedDraft.draft.updated_at_formatted);
            }).fail(function() {
                alert( "There was an error processing this request :(" );
            });
        }

        function openInNewTab() {
            var newTab = window.open('/page/preview/' + currentDraft, '_blank');
            newTab.focus();
        }

        function getFormContent() {
            $('#textboxCkeditor').text(CKEDITOR.instances.textboxCkeditor.getData());
            return $('#new-page-form').serializeArray();
        }

        function getPostUrl() {
            return "/page/preview/save" + (typeof currentDraft == 'number' ? '/' + currentDraft : '');
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
