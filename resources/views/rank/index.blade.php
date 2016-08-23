@extends('layouts.master')

@section('content')

<h1>Rankings</h1>

<hr>
<p>Rankings are determined based on user contributions to pages, page updates and code. Higher = more awesome, thats all you need to know.</p>
<table class="table table-striped table-bordered table-hover dataTables-example m-t-xl">
    <thead>
        <tr>
            <th>Rank</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ranked as $name => $rank)
        <tr>
            <td>{{ $rank }}</td>
            <td>{{ $name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop

@section('scripts')

@stop
