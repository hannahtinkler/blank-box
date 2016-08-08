@extends('layouts.master')

@section('content')


<h1>Black Box Contributors</h1>

<hr>

<p>Black Box is a community project, contributed to by many hands from the Mayden developer family. If you'd like to be one (or two) such hands, you could:</p>

<ul>
    <li class="m-t-md">Add new pages whenever you find yourself making notes that might help someone else, think of something important that isn't already covered here, or just whenever you have a spare 10 minutes. (Okay, maybe that last one is unlikely. But you could make time maybe?)</li>
    <li class="m-t-md">Volunteer as a curator, meaning you'd help maintain the quality and readability of the pages and suggested edits that are submitted to the knowledge base.</li>
    <li class="m-t-md">Fork the Black Box repositiory and submit all kinds of information-centric paraphernalia and code-iness via pull request. If you'd like to be able to refer to Black Box for something it does not yet offer, you could build it.</li>
</ul>

<h2 class="m-t-xl">Current Contributors</h2>

@foreach($contributors as $contributor)
    <p><a href="/u/{{ $contributor->slug }}">{{ $contributor->name }}</a></p>
@endforeach

@stop


@section('scripts')

@stop