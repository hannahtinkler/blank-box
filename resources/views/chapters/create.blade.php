@extends('layouts.master')

@section('content')

    <h1>Create New Chapter</h1>

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

        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">

                    <form role="form" id="new-chapter-form" action="/chapters" method="POST">
                        {!! csrf_field() !!}
                    
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option>Select a category...</option>
                                @foreach($categories as $category)
                                    <option {!! $category->id == old('category_id') ? "selected" : null !!} value="{{ $category->id }}">
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label>Chapter Title</label>
                            <input class="form-control" value="{{ old('title') }}" name="title" id="title" />
                        </div>

                    
                        <div class="form-group">
                            <label>Chapter Description</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                        </div>


                    <div class="m-t-md m-b-xl text-right">
                        <button class="btn btn-sm btn-primary m-t-n-xs" type="submit">
                            <strong>Save Chapter</strong>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop
