@extends('layouts.master')

@section('content')

<h1>Search Results</h1>
<h2>"{{ $searchTerm }}"</h2>

<hr>
@if(empty($results))
    <p>Your search query returned no results, try again with a different query.</p>
@else
    <ul class="chapter-list">
        @foreach($results as $result)
            <li>
                <h4>
                    {!! $result->searchResultIcon !!}
                    <a href="{{ $result->searchResultUrl }}">{{ $result->searchResultString }}</a>
                </h4>

                @if(isset($result->description))
                    <p>{{ $result->description }}</p>
                @endif
            </li>
        @endforeach
    </ul>
@endif

@stop
