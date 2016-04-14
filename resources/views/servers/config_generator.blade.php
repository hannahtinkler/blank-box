@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->title }}</h1>
<h2>{{ $page->title }}</h2>

<hr>

<p>Generate an SSH config file with which to connect to Mayden servers. You can only do this once you have received your server SSH keys and put them into your '.ssh' directory. If you place them into a sub directory within the '.ssh' directory, include this directory when you enter the ssh key file names below. Once you have downloaded the config file, place the file in the root of your '.ssh' folder, overwriting any config file that might already exist there. You will then be able to connect SSH into the Mayden servers using 'ssh ipatusvnode#' commands (where # is the node number).</p>

<br />
@if(session('error'))
    <p class="bg-danger error-message"><i class="glyphicon glyphicon-remove"></i> {!! session('error') !!}</p>
@endif
<br />

<form id="config-generator"  action="/p/mayden/servers/ssh-config-generator" method="POST">
    {{ csrf_field() }}
    <label for="key_name">SSH Key Filename - Bournemouth: </label>
    <div class="form-group">
        <input type="text" class="form-control" value="{{ old('bournemouth_key') }}" name="bournemouth_key" id="key_name" />
        <span class="config-prefix">.ssh/</span>
    </div>
    <label for="key_name">SSH Key Filename - Bracknell: </label>
    <div class="form-group">
        <input type="text" class="form-control" value="{{ old('bracknell_key') }}" name="bracknell_key" id="key_name" />
        <span class="config-prefix">.ssh/</span>
    </div>
    <small class="italic help-block">Please do not include the file extension in the key file name</small>
    <br/>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

@stop


@section('scripts')
@stop
