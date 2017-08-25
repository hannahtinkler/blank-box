@extends('layouts.master')

@section('content')

<h1>Contributors</h1>

<hr>
<p>Contributors help to build up this resource by adding pages and making edits that refine the quality of them. These rankings are determined based on user contributions to pages, page updates and code contributions. Higher = more awesome, thats all you need to know.</p>
<table class="table table-striped table-bordered dataTables-example m-t-xl">
    <thead>
        <tr>
            <th class="col-md-1 text-center">Rank</th>
            <th class="col-md-3">User</th>
            <th class="text-center">Score</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ranked as $name => $data)
        <tr>
            <td class="col-md-1 text-center">{{ $data['rank'] }}</td>
            <td class="col-md-3"><a href="/u/{{ $data['slug'] }}">{{ $name }}</a></td>
            <td class="text-center">{{ $data['score'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop

@section('scripts')

@stop
