@extends('layouts.master')

@section('content')

    <h1>Edit Chapter</h1>

    <hr>
    <div class="row">
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
        <div class="col-sm-6">

            <form role="form" id="edit-chapter-form" action="/chapters/{{ $chapter->id }}" method="POST">
                
                {!! csrf_field() !!}

                {!! method_field('PUT') !!}

                <div class="col-sm-12">
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
    </div>
</div>

@stop
