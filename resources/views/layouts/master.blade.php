<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo config('global.site-name'); ?></title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/easy-autocomplete.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />

    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/favicon.ico" type="image/x-icon" />

</head>


<body class="<?php echo config('global.theme'); ?>">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">

                <li class="nav-header">
                     <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="table_data_tables.html#">
                            <span class="clear">
                                <span class="text-mutedblock" title="Switch Categories">{{ $current['category']->title }} 
                                @if($categories->count() > 1)
                                    <b class="caret"></b></span>
                                @endif
                            </span>
                        </a>
                        <ul class="dropdown-menu animated module-menu fadeInRight m-t-xs">
                            @foreach($categories as $category)
                                @if($category->title != $current['category']->title)
                                    <li><a href="/switchcategory/{{ $category->id }}">{{ $category->title }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li{!! Request::is('/') ? ' class="active"' : null !!}>
                    <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
                </li>

                @if(is_object($current['category']->chapters))

                    @foreach($current['category']->chapters as $chapter)
                        @if(!$chapter->approvedPages->isEmpty())
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
                            
                                @if(!$chapter->approvedPages->isEmpty())
                                    <ul class="nav nav-second-level collapse">
                                        <li><a href="/p/{{ $current['category']->slug }}/{{ $chapter->slug }}"><i class="fa fa-bars"></i> View All</a></li>
                                        @foreach($chapter->pages as $page)
                                            <li>
                                                <a href="/p/{{ $current['category']->slug }}/{{ $chapter->slug }}/{{ $page->slug }}"><i class="fa fa-file-o"></i>  {{ $page->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
                <li class="spacer"><hr></li>
                @if($user->curator)
                    <li{!! Request::is('curation/*') ? ' class="active"' : null !!}>
                        <a href="/curation">
                            <span class="nav-label"><i class="fa fa-check"></i> <span class="nav-label">Curation</span> ({{ $awaitingCurationCountNew + $awaitingCurationCountEdits }})</span>
                            <span class="fa arrow"></span>
                        </a>
                    
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="/curation/new"><i class="fa fa-file-o"></i> <span class="nav-label">New Pages </span>({{ $awaitingCurationCountNew }})</a>
                            </li>
                            <li>
                                <a href="/curation/edits"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Suggested Edits </span>({{ $awaitingCurationCountEdits }})</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li
                    @if(Request::is('u/' . $user->slug . '*') || Request::is('bookmarks'))
                    class="active"
                    @endif
                >
                    <a href="/u/{{ $user->slug }}">
                        <span class="nav-label">
                            <i class="fa fa-user"></i> Your <?php echo config('global.site-name'); ?>
                            <span {!! $newBadgeCount + $draftCount == 0 ? 'class="hidden"' : null !!} id="your-count">(<span>{{ $newBadgeCount + $draftCount }}</span>)</span>
                        </span>
                        <span class="fa arrow"></span>
                    </a>
                
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="/u/{{ $user->slug }}"><i class="fa fa-user"></i> <span class="nav-label">Profile</span></a>
                        </li>
                        <li>
                            <a href="/u/{{ $user->slug }}/drafts">
                                <i class="fa fa-pencil-square-o"></i> 
                                <span class="nav-label">Drafts 
                                    <span {!! $draftCount == 0 ? 'class="hidden"' : null !!} id="draft-count">(<span>{{ $draftCount }}</span>)</span>
                                </span>
                            </a>
                        </li>
                        
                        @if (config('global.badges_enabled'))
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

                <li class="spacer"><hr></li>
                
                <li{!! Request::is('pages/latestupdates') ? ' class="active"' : null !!}>
                    <a href="/pages/latestupdates"><i class="glyphicon glyphicon-hourglass"></i> <span class="nav-label">Latest Updated Pages</span></a>
                </li>
                <li{!! Request::is('contributors') ? ' class="active"' : null !!}>
                    <a href="/contributors"><i class="fa fa-hand-peace-o"></i> <span class="nav-label">Contributors</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row">
        <nav class="navbar navbar-fixed-top fixed-nav" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">

                <div class="navbar-minimalize logo-space">
                    <a href="#"><i class="fa fa-cube"></i> <?php echo config('global.site-name'); ?></a>
                </div>
                
                <i class="minimalize-styl-2 glyphicon glyphicon-search bigger-icon"></i>
                <form role="search" class="navbar-form-custom" id="topbar-search-form">
                    <div class="form-group">
                        <input type="text" placeholder="Search.." class="form-control" name="top-search" id="top-search" {!! isset($searchTerm) ? 'value="'. $searchTerm .'"' : null !!}>
                    </div>
                </form>

                <div class="right topbar-icons">
                    <a href="/chapters/create" title="Add a new chapter">
                        <span class="add-new"><i class="fa fa-folder-open-o"></i><i class="fa fa-plus"></i></span>
                    </a>
                    <a href="/pages/create" title="Add a pages/content">
                        <span class="add-new"><i class="fa fa-file-o"></i><i class="fa fa-plus"></i></span>
                    </a>
                    <a href="/random" title="Take me to a random page"><i class="fa fa-random"></i></a>
                </div>
            </div>
            <!-- <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="article.html#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul> -->

        </nav>
        </div>

        <div class="row row-first-content">
            @if(isset($current['page']))
                <i class="glyphicon glyphicon-bookmark bookmark {{ is_object($current['page']->bookmark) ? 'active' : null }}" title="Click to bookmark this page"></i>
            @elseif(isset($current['chapter']))
                <i class="glyphicon glyphicon-bookmark bookmark {{ is_object($current['chapter']->bookmark) ? 'active' : null }}" title="Click to bookmark this chapter"></i>
            @endif
            @yield ('content') 
        </div>

        <div class="footer">
            <!-- <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div> -->
            <div>
                <strong>&copy;</strong> <?php echo config('global.site-name'); ?> {{ date('Y') }}
            </div>
        </div>

        </div>
        </div>



<!-- Main scripts -->
<script src="/js/jquery-2.1.1.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/js/easyAutocomplete.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="https://www.draw.io/js/embed-static.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/js/inspinia.js"></script>
<script src="/js/plugins/pace/pace.min.js"></script>

</body>

@yield('scripts')

<script>
    $(document).ready(function() {
        @if(isset($current['chapter']))
            var category = {!! $current['category'] ? $current['category']->id : '""' !!};
            var chapter = {!! $current['chapter'] ? $current['chapter']->id : '""' !!};
            var page = {!! $current['page'] ? $current['page']->id : '""' !!};

            $('.bookmark').click(function() {
                if($(this).hasClass('active')) {
                    removeBookmark();
                } else {
                    addBookmark();
                }
            });

            function addBookmark() {
                $('.bookmark').addClass('active');
                $.ajax('/u/{{ $user->slug }}/bookmarks/create/' + category + '/' + chapter + '/' + page, {
                  success: function(data) {
                    data = JSON.parse(data);
                  },                  
                  error: function() {
                    $('.bookmark').removeClass('active');
                    alert('Bookmark creation failed');
                  }
               });
            }

            function removeBookmark() {
                $('.bookmark').removeClass('active');
                $.ajax('/u/{{ $user->slug }}/bookmarks/delete/' + category + '/' + chapter + '/' + page, {
                  success: function(data) {
                    data = JSON.parse(data);
                  },
                  error: function() {
                    $('.bookmark').addClass('active');
                    alert('Bookmark removal failed');
                  }
               });
            }

        @endif

        $('#topbar-search-form').submit(function(e) {
            var term = $('#top-search').val();
            window.location.href ='/search/' + term + '/results';
            e.preventDefault();
            return false;
        });

        $('#top-search').easyAutocomplete({
            adjustWidth: false,
            url: function(term) {
                    return "/search/" + term;
            },
            getValue: "content",
            template: {
                type: "links",
                fields: {
                    link: "url"
                }
            },
            list: {
                maxNumberOfElements: 10,
                onShowListEvent: function() {
                    var list = $('body').find('#eac-container-top-search ul');
                    var term = $('#top-search').val();
                    if (list.text().indexOf('View All Results') == -1) {
                        list.append('<li id="view-all"><a href="/search/' + term + '/results"><strong>View All Results</strong></a></li>');
                    }
                }
            }
        });
    });
</script>

</html>

