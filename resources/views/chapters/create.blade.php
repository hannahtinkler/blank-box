@extends('layouts.master')

@section('content')

    <h1>Create New Chapter</h1>

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

    <form role="form" id="new-chpater-form" action="/chapter/store" method="POST">
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
        <div class="col-sm-12">
            <div class="form-group">
                <label>Chapter Title</label>
                <input class="form-control" value="{{ old('title') }}" name="title" id="title" />
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label>Chapter Description</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            </div>
        </div>


        <div class="col-sm-12 m-t-md m-b-xl">
            <div class="btn-toolbar pull-right">
                <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Save Chapter</strong></button></div>
            </div>
        </div>
    </form>

@stop
