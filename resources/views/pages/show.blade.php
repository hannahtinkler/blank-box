@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->category->title }} - {{ $page->chapter->title }}</h1>
@include('partials.page_options')
<h2>
    {{ $page->title }}
    @if(config('app.curation_enabled') && $page->approved === null)
        <span class="label label-warning m-l-sm"><i class="fa fa-flag"></i> Pending Curation</span>
    @elseif($page->approved === 0)
        <span class="label label-danger m-l-sm"><i class="fa fa-remove"></i> Rejected</span>
    @endif
</h2>

<h4 class="m-t-xl m-b-lg">{{ $page->description }}</h4>

<hr>

@if(session('message'))
    <p class="bg-success error-message m-b-xl">{!! session('message') !!}</p>
@elseif(count($errors) > 0)
    <div class="bg-danger error-message m-b-xl">
        <h4><i class="glyphicon glyphicon-remove"></i> There were some errors with your resource:</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="generated-page-content">
    {!! $page->content !!}
</div>

@if($page->chapter->projects_chapter || $page->has_resources)
    <h3 class="m-t-xl">
        Project Resources
    </h3>

    <tabs class="nav-tertiary" :options="{ useUrlFragment: false }" @changed="e => $root.$emit('tab-changed', e)">
        @foreach($resources as $category => $items)
            <tab name="{{ $category }}">
                <table class="table table-hover m-b-sm">
                    <tr class="table-heading">
                        <td colspan="4">
                            <div id="category{{ $category }}" class="hidden-anchor"></div>
                            <h4 class="m-t-md m-b-lg">{{ $category }}:</h4>
                        </td>
                    </tr>

                    @foreach($items as $item)
                        <tr>
                            <td class="text-left twenty-percent">
                                <span class="border-left" style="border-color: #{{ $item->resourceType->color }};">{{ $item->name }}</span>
                            </td>
                            <td class="text-left fifteen-percent"><small>({{ $item->resourceType->name }})</small></td>
                            <td class="text-left">
                                @if (filter_var($item->content, FILTER_VALIDATE_URL))
                                    <a target="_blank" href="{{ $item->content }}">
                                        {{ $item->content }}
                                    </a>
                                @elseif ($linkedUser = App\Models\User::where('name', $item->content)->first())
                                    <a target="_blank" href="/u/{{ $linkedUser->slug }}">{{ $item->content }}</a>
                                @else
                                    {{ $item->content }}
                                @endif
                            </td>
                            <td class="icon-column">
                                <a class="hide-until-hover" href="/pageresources/edit/{{ $item->id }}"><i class="fa fa-pencil"></i></a>
                                <a class="hide-until-hover" href="/pageresources/delete/{{ $item->id }}"><i class="fa fa-trash m-l-sm"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </tab>
        @endforeach

        <tab name="{{ '<i class="fa fa-forge"></i>' }}" cache-lifetime="604800">
            <forge-sites :page-id="{{ $page->id }}"></forge-sites>

            @if($user->curator)
                <div class="m-l-xs">
                    <h4 class="m-t-md m-b-md">
                        Link project to Forge site
                    </h4>

                    <form id="add-resource-form" action="/forge-links" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="page_id" value="{{ $page->id }}" />

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Server ID</label>
                                    <input type="text" class="form-control" name="server_id" placeholder="11156" value="{{ old('name') }}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Site ID</label>
                                    <input type="text" class="form-control" name="site_id" placeholder="435799" value="{{ old('name') }}" />
                                </div>
                            </div>

                            <div class="col-sm-12 m-t-md">
                                <div class="btn-toolbar pull-right">
                                    <div class="btn-group"><button tabindex="-1" id="add-resource-cancel-button" class="btn btn-sm btn-default m-t-n-xs" type="button"><strong>Cancel</strong></button></div>
                                    <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Save</strong></button></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </tab>

        <tab name="{{ '<i class="fa fa-plus"></i>' }}">
            <form id="add-resource-form" action="/pageresources" method="POST">
                <h4 class="m-t-sm m-b-md">Add Resource</h4>

                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $page->id }}" />

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Resource Name</label>
                            <input type="text" class="form-control" name="name" placeholder="E.g. 'Designer', 'Website Progress Board', 'User Stories' etc" value="{{ old('name') }}" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Resource Type</label>
                            <select class="form-control" name="type">
                                <option value="">Select a type...</option>
                                @foreach ($resourceTypes as $category => $types)
                                    <optgroup label="{{ $category }}">
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Resource Content</label>
                            <input placeholder="E.g. a server path, website link, document link, person name etc" type="text" class="form-control" name="content" value="{{ old('name') }}" />
                        </div>
                    </div>

                    <div class="col-sm-12 m-t-md">
                        <div class="btn-toolbar pull-right">
                            <div class="btn-group"><button tabindex="-1" id="add-resource-cancel-button" class="btn btn-sm btn-default m-t-n-xs" type="button"><strong>Cancel</strong></button></div>
                            <div class="btn-group"><button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Save</strong></button></div>
                        </div>
                    </div>
                </div>
            </form>
        </tab>
    </tabs>
@endif

<div class="m-t-lg green-text m-b-lg">
    <small>Written by <strong><a href="/u/{{ $page->creator->slug }}">{{ $page->creator->name }}</a></strong>
    @if($page->hasEdits)
        @set('updators', $page->updatorsString)

        @if(strlen($updators) <= 160)
            and updated by {!! $page->updatorsString !!}
        @else
            and updated by many other lovely people
        @endif
    @endif
    </small>
</div>

@stop

@section('scripts')
<script>
    $(document).ready(function() {
        $('#add-resource-button').click(function() {
            $(this).addClass('hide')
            $('#add-resource-form').removeClass('hide')
        })
        $('#add-resource-cancel-button').click(function() {
            $('#add-resource-button').removeClass('hide')
            $('#add-resource-form').addClass('hide')
        })
    })
</script>
@stop
