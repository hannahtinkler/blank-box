@extends('layouts.master')

@section('content')

    <h1>{{ $link->page->title }}</h1>
    <h2>{{ $site->name }}</h2>

    <h3 class="m-t-xl m-b-lg">Edit active branch</h3>

    <hr>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <p class="warn m-t-xl">
                Editing the branch this way assumes that the branch specified in the deployment script matches the quick deploy branch. If it doesn't, this will need to be done through Forge.
            </p>
        </div>
    </div>

    @if(count($errors) > 0)
        <div class="bg-danger error-message m-b-xl m-t-xl">
            <h5><i class="glyphicon glyphicon-remove"></i> There were some errors:</h5>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/forge-links/{{ $link->id }}/branch" class="m-t-lg" method="POST">
        <div class="row">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label>New Branch</label>
                    <input class="form-control" name="branch" placeholder="e.g. release/v1.0" value="{{ old('branch') ? old('branch') : '' }}" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="btn-toolbar m-b-xl">
                    <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Submit</strong></button>
                </div>
            </div>
        </form>
    </div>
@stop
