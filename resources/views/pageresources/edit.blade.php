@extends('layouts.master')

@section('content')

<h1>Edit Page Resource</h1>

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
</div>

<form role="form" action="/pageresources/update/{{ $resource->id }}" method="GET">
    {{ csrf_field() }}
    
    <input type="hidden" name="id" value="{{ $resource->page->id }}" />

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Resource Name</label> 
                <input type="text" class="form-control" name="name" placeholder="E.g. 'Designer', 'Website Progress Board', 'User Stories' etc" value="{{ old('name') ?: $resource->name }}" />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Resource Type</label> 
                <select class="form-control" name="type">
                    <option value="">Select a type...</option>
                    @foreach ($resourceTypes as $category => $types)
                        <optgroup label="{{ $category }}">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ old('type') == $type->id || $resource->type == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Resource Content</label> 
                <input placeholder="E.g. a server path, website link, document link, person name etc" type="text" class="form-control" name="content" value="{{ old('name') ?: $resource->content }}" />
            </div>
        </div>

        <div class="col-sm-12 m-t-md m-b-xl">
            <div class="btn-toolbar pull-right">
                <div class="btn-group"><button tabindex="-1" id="add-resource-cancel-button" class="btn btn-sm btn-default m-t-n-xs" type="button"><strong>Cancel</strong></button></div>
                <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Save</strong></button></div>
            </div>
        </div>
    </div>
</form>

@stop
