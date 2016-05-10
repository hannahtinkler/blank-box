@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->title }}</h1>
<h2>{{ $page->title }}</h2>

<hr>

<p>Generate an SSH config file with which to connect to Mayden servers. You can only do this once you have live access and have been sent your server SSH keys. Move these keys directly to your '.ssh' directory for compatibility with this file download (or include sub directories in the filename if you want to be more organised).</p>

<p>Once you have downloaded this config file, place the file in the root of your '.ssh' folder, overwriting any config file that might already exist there. You will then be able to connect SSH into the Mayden servers using the following commands (provided you have been granted access). Using the correct port forwarding settings (which you can find <a href="/p/mayden/servers/server-details">here</a> for any server by clicking the plus button), you will be able to access any iaptus database from either iaptus SSH commands.</p>
<br />
<ul class="commands-list">
    <li><code>ssh iaptusbracknell</code> - will SSH you onto the Bracknell server via your Bracknell VPN connection</li>
    <li><code>ssh iaptusbournemouth</code> - will SSH you onto the Bournemouth server via your Bournemouth VPN connection</li>
    <li><code>ssh bacpac-staging</code> - will SSH you onto the BacPac staging server via your Bournemouth VPN connection</li>
    <li><code>ssh bacpac-live</code> - will SSH you onto the BacPac Live server via your Bournemouth VPN connection</li>
    <li><code>ssh paywall</code> - will SSH you onto the Paywall server via your Bournemouth VPN connection</li>
    <li><code>ssh iaptusdemo</code> - will SSH you onto the Demo server via your Bournemouth VPN connection</li>
    <li><code>ssh webforms-application</code> - will SSH you onto the Webforms application server via your Bournemouth VPN connection</li>
    <li><code>ssh webforms-database</code> - will SSH you onto the Webforms database server via your Bournemouth VPN connection</li>
</ul>

<br />
@if(session('error'))
    <p class="bg-danger error-message"><i class="glyphicon glyphicon-remove"></i> {!! session('error') !!}</p>
@endif
<br />

<form id="config-generator"  action="/p/mayden/servers/ssh-config-generator" method="POST">
    {{ csrf_field() }}
    <label for="key_name">SSH Username: </label>
    <div class="form-group">
        <input type="text" class="form-control" value="{{ old('ssh_username') }}" name="ssh_username" placeholder="mayhealthv_abc" id="ssh_username" />
    </div>
    <label for="key_name_bmth">SSH Key Filename - Bournemouth: </label>
    <div class="form-group">
        <input type="text" class="form-control prefix-field" value="{{ old('bournemouth_key') }}" name="bournemouth_key" placeholder="abc_bournemouth" id="key_name_bmth" />
        <span class="config-prefix">.ssh/</span>
    </div>
    <small class="italic help-block">Please do not include the file extension in the key file name</small>
    <label for="key_name_brck">SSH Key Filename - Bracknell: </label>
    <div class="form-group">
        <input type="text" class="form-control prefix-field" value="{{ old('bracknell_key') }}" name="bracknell_key" placeholder="abc_bracknell" id="key_name_brck" />
        <span class="config-prefix">.ssh/</span>
    </div>
    <small class="italic help-block">Please do not include the file extension in the key file name</small>
    <br/>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

@stop


@section('scripts')
@stop
