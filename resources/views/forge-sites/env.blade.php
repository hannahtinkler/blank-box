@extends('layouts.master')

@section('content')

    <h1>{{ $link->page->title }}</h1>
    <h2>{{ $site->name }}</h2>

    <h3 class="m-t-xl m-b-lg">Edit .env file</h3>

    <hr>

    <div class="m-b-xl m-t-xl">
        <form action="/forge-links/{{ $link->id }}/env" method="POST">
            {{ csrf_field() }}

            <input type="hidden" name="_method" value="PATCH" />
            <textarea name="env" rows="50">{{ $env }}</textarea>

            <div class="btn-toolbar pull-right m-t-md m-b-xl">
                <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Submit</strong></button>
            </div>
        </form>
    </div>
@stop
