@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->category->title }} - {{ $page->chapter->title }}</h1>
<h2>
    {{ $page->title }}
</h2>

<h4 class="m-t-xl m-b-lg">{{ $page->description }}</h4>

<hr>

<div class="mxgraph" style="max-width:100%;" data-mxgraph="{&quot;highlight&quot;:&quot;#0000ff&quot;,&quot;nav&quot;:true,&quot;edit&quot;:&quot;_blank&quot;,&quot;xml&quot;:&quot;&lt;mxfile userAgent=\&quot;Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36\&quot; version=\&quot;5.6.0.5\&quot; editor=\&quot;www.draw.io\&quot; type=\&quot;google\&quot;&gt;&lt;diagram&gt;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&lt;/diagram&gt;&lt;/mxfile&gt;&quot;}"></div>

<div class="m-t-lg green-text">
    <small>Written by <strong><a href="/u/{{ $page->creator->slug }}">{{ $page->creator->name }}</a></strong>
</div>


@stop