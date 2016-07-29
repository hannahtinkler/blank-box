@extends('layouts.master')

@section('content')

<h1>Related Resources Results</h1>
<h2>"{{ $relatedTerm }}"</h2>

<hr>
@if(empty($results))
    <p>This task has no related resources, why don't you add some when you've worked out how to do whatever you're doing?</p>
@else
    <ul class="chapter-list">
        @foreach($results as $result)
            <li>
                <h4><a href="{{ $result['url'] }}">{{ $result['title'] }}</a></h4>
                <p>{{ $result['description'] }}</p>
            </li>
        @endforeach
    </ul>
@endif

@stop


@section('scripts')

@stop
