<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">

            <li class="nav-header">
                 <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="table_data_tables.html#">
                        <span class="clear">
                            <span class="text-mutedblock" title="You are currently exploring the {{ $current['category']->title }} category. Click to switch categories.">
                            {{ $current['category']->title }}
                            @if($categories->count() > 1)
                                <b class="caret"></b></span>
                            @endif
                        </span>
                    </a>

                    @if($categories->count() > 1)
                        <ul class="dropdown-menu animated module-menu fadeInRight m-t-xs">
                            @foreach($categories as $category)
                                @if($category->title != $current['category']->title)
                                    <li><a href="/switchcategory/{{ $category->id }}">{{ $category->title }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            </li>

            <li{!! Request::is('/') ? ' class="active"' : null !!}>
                <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>

            @if(is_object($current['category']->chapters))

                @foreach($current['category']->chapters as $chapter)
                    @if(isset($current['chapter']))
                        <li{!! $current['chapter']->id == $chapter->id ? ' class="active"' : null !!}>
                    @else
                        <li>
                    @endif
                        <a href="/p/{{ $current['category']->slug }}/{{ $chapter->slug }}">
                            <i class="fa fa-folder-open-o"></i>
                            <span class="nav-label">{{ $chapter->title }}</span>
                            @if(!$chapter->approvedPages->isEmpty())
                                <span class="fa arrow"></span>
                            @endif
                        </a>

                        <ul class="nav nav-second-level collapse">
                            <li class="collapsed-chapter-title">
                                {{ $chapter->title }}
                            </li>
                            <li>
                                <a href="/p/{{ $current['category']->slug }}/{{ $chapter->slug }}"><i class="fa fa-bars"></i> View All</a>
                            </li>
                            @foreach($chapter->pages as $page)
                                <li>
                                    <a href="/p/{{ $current['category']->slug }}/{{ $chapter->slug }}/{{ $page->slug }}">
                                        @if($chapter->projects_chapter || $page->has_resources)
                                            <i class="fa fa-inbox"></i>
                                        @else
                                            <i class="fa fa-file-o"></i>
                                        @endif
                                        {{ $page->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
            <li class="spacer"><hr></li>
            @if($user->curator && env('FEATURE_CURATION_ENABLED'))
                <li{!! Request::is('curation/*') ? ' class="active"' : null !!}>
                    <a href="/curation">
                        <i class="fa fa-check"></i>
                        <span class="nav-label">
                            <span class="nav-label">Curation</span> ({{ $curation['new'] + $curation['edits'] }})
                        </span>
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level collapse">
                        <li class="collapsed-chapter-title">
                            Curation
                        </li>
                        <li>
                            <a href="/curation/new"><i class="fa fa-file-o"></i> <span class="nav-label">New Pages </span>({{ $curation['new'] }})</a>
                        </li>
                        <li>
                            <a href="/curation/edits"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Suggested Edits </span>({{ $curation['edits'] }})</a>
                        </li>
                    </ul>
                </li>
            @endif

            <li{!! Request::is('u/' . $user->slug . '*') || Request::is('bookmarks') ? ' class="active"' : null !!}>
                <a href="/u/{{ $user->slug }}">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">
                        Your <?php echo env('APP_NAME', 'Black Box'); ?>
                        <span {!! $newBadgeCount + $drafts == 0 ? 'class="hidden"' : null !!} id="your-count">(<span>{{ $newBadgeCount + $drafts }}</span>)</span>
                    </span>
                    <span class="fa arrow"></span>
                </a>

                <ul class="nav nav-second-level collapse">
                    <li class="collapsed-chapter-title">
                        Your <?= env('APP_NAME', 'Blank Box') ?>
                    </li>
                    <li>
                        <a href="/u/{{ $user->slug }}"><i class="fa fa-user"></i> <span class="nav-label">Profile</span></a>
                    </li>
                    <li>
                        <a href="/u/{{ $user->slug }}/drafts">
                            <i class="fa fa-pencil-square-o"></i>
                            <span class="nav-label">Drafts
                                <span {!! $drafts == 0 ? 'class="hidden"' : null !!} id="draft-count">(<span>{{ $drafts }}</span>)</span>
                            </span>
                        </a>
                    </li>

                    @if (env('FEATURE_BADGES_ENABLED', true))
                        <li>
                            <a href="/u/{{ $user->slug }}/badges">
                                <i class="fa fa-shield"></i>
                                <span class="nav-label">Badges
                                    <span {!! $newBadgeCount == 0 ? 'class="hidden"' : null !!} id="badge-count">(<span>{{ $newBadgeCount }}</span>)</span)
                                </span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="/u/{{ $user->slug }}/bookmarks"><i class="glyphicon glyphicon-bookmark"></i> <span class="nav-label">Bookmarks</span></a>
                    </li>
                </ul>
            </li>

            <li{!! Request::is('/rankings') || Request::is('rankings') ? ' class="active"' : null !!}>
                <a href="/rankings">
                    <i class="fa fa-hand-peace-o"></i>
                    <span class="nav-label">
                        Contributors
                    </span>
                </a>
            </li>
        </ul>

    </div>
</nav>
