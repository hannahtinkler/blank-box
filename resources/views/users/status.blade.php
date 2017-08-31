@extends('layouts.master')

@section('content')

    <h1>Edit Status</h1>

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
        <div class="col-sm-12">

            <form role="form" action="/u/status" method="POST">

                {!! csrf_field() !!}

                {!! method_field('PUT') !!}

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <input class="form-control" value="{{ old('status') ? old('status') : $user->status }}" name="status" id="status" placeholder="You can enter text and certain HTML tags here (<a>, <i> and <strong>)" />
                    </div>
                </div>

                <div class="col-sm-12 m-t-md m-b-xl">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Save</strong></button></div>
                    </div>
                </div>
            </form>
    </div>
</div>

@stop
