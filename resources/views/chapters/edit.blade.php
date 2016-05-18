@extends('layouts.master')

@section('content')
    <h2>Edit: {{ $chapter->title }}</h2>

    <hr>

    @if(session('message'))
        <p class="bg-success error-message"><i class="glyphicon glyphicon-check"></i> {!! session('message') !!}</p>
    @endif

    <form role="form" id="edit-chapter-form" action="/chapter/update/{{ $chapter->id }}" method="PUT">
        {!! csrf_field() !!}
        <div class="col-sm-6">
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option>Select a category...</option>
                    @foreach($categories as $category)
                        <option {!! $category->id == $chapter->category->id ? "selected" : null !!} value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label>Chapter Title</label>
                <input class="form-control" value="{{ old('title') ? old('title') : $chapter->title }}" name="title" id="title" />
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label>Chapter Description</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') ? old('description') : $chapter->description }}</textarea>
            </div>
        </div>

        <div class="col-sm-12 m-t-md m-b-xl">
            <div class="btn-toolbar pull-right">
                <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Save Changes</strong></button></div>
            </div>
        </div>
    </form>

@stop
