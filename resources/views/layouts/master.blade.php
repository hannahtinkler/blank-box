<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Black Box</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/easy-autocomplete.min.css">

    
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/favicon.ico" type="image/x-icon" />

</head>


<body class="mayden-skin">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li{!! Request::is('/') ? ' class="active"' : null !!}>
                    <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
                </li>

                @foreach($categories as $category)
                    @if(!$category->chapters->isEmpty())
                        @if($current['category'] != null)
                            <li{!! $current['category']->id == $category->id ? ' class="active"' : null !!}>
                        @else
                            <li>
                        @endif
                            <a>
                                <i class="fa fa-book"></i>
                                <span class="nav-label">{{ $category->title }}</span>
                                @if(is_object($category->chapters))
                                    <span class="fa arrow"></span>
                                @endif
                            </a>


                            @if(is_object($category->chapters))
                                <ul class="nav nav-second-level collapse">
                                    @foreach($category->chapters as $chapter)
                                        @if(!$chapter->pages->isEmpty())
                                            @if($current['chapter'] != null)
                                                <li{!! $current['chapter']->id == $chapter->id ? ' class="active"' : null !!}>
                                            @else
                                                <li>
                                            @endif
                                                <a href="/p/{{ $category->slug }}/{{ $chapter->slug }}">
                                                    <i class="fa fa-folder-open-o"></i>
                                                    <span class="nav-label">{{ $chapter->title }}</span>
                                                    @if(!$chapter->pages->isEmpty())
                                                        <span class="fa arrow"></span>
                                                    @endif
                                                </a>
                                            
                                                @if(!$chapter->pages->isEmpty())
                                                    <ul class="nav nav-third-level collapse">
                                                        <li><a href="/p/{{ $category->slug }}/{{ $chapter->slug }}"><i class="fa fa-bars"></i> View All</a></li>
                                                        @foreach($chapter->pages as $page)
                                                            <li>
                                                                <a href="/p/{{ $category->slug }}/{{ $chapter->slug }}/{{ $page->slug }}"><i class="fa fa-file-o"></i>  {{ $page->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
                <li{!! Request::is('/bookmarks') ? ' class="active"' : null !!}>
                    <a href="/bookmarks"><i class="glyphicon glyphicon-bookmark"></i> <span class="nav-label">Your Bookmarks (<span id="bookmark-count">{{ $bookmarks }}</span>)</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row">
        <nav class="navbar navbar-fixed-top fixed-nav" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">

                <div class="navbar-minimalize logo-space">
                    <a href="#"><i class="fa fa-cube"></i> Black Box</a>
                </div>
                
                <i class="minimalize-styl-2 glyphicon glyphicon-search bigger-icon"></i>
                <form role="search" class="navbar-form-custom" method="post" action="#">
                    <div class="form-group">
                        <input type="text" placeholder="Search.." class="form-control" name="top-search" id="top-search">
                    </div>
                </form>

                <div class="right topbar-icons">
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
            @if($current['page'] != null)
                <i class="glyphicon glyphicon-bookmark bookmark {{ is_object($current['page']->bookmarks) ? 'active' : null }}" title="Click to bookmark this page"></i>
            @elseif($current['chapter'] != null)
                <i class="glyphicon glyphicon-bookmark bookmark {{ is_object($current['chapter']->bookmarks) ? 'active' : null }}" title="Click to bookmark this chapter"></i>
            @endif
            @yield ('content') 
        </div>

        <div class="footer">
            <!-- <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div> -->
            <div>
                <strong>&copy;</strong> Black Box {{ date('Y') }}
            </div>
        </div>

        </div>
        </div>



<!-- Mainl scripts -->
<script src="/js/jquery-2.1.1.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/js/easyAutocomplete.js"></script>

<!-- Custom and plugin javascript -->
<script src="/js/inspinia.js"></script>
<script src="/js/plugins/pace/pace.min.js"></script>

</body>

@yield('scripts')

<script>
    $(document).ready(function() {
        $(window).resize(function() {
            $('#page-wrapper').height($(window).height());
        });

        @if($current['chapter'] != null)
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
                $.ajax('/bookmarks/create/' + category + '/' + chapter + '/' + page, {
                  success: function(data) {
                    data = JSON.parse(data);
                    $('#bookmark-count').html(data.count);
                  },                  
                  error: function() {
                    $('.bookmark').removeClass('active');
                    alert('Bookmark creation failed');
                  }
               });
            }

            function removeBookmark() {
                $('.bookmark').removeClass('active');
                $.ajax('/bookmarks/delete/' + category + '/' + chapter + '/' + page, {
                  success: function(data) {
                    data = JSON.parse(data);
                    $('#bookmark-count').html(data.count);
                  },
                  error: function() {
                    $('.bookmark').addClass('active');
                    alert('Bookmark removal failed');
                  }
               });
            }

        @endif

        $('#top-search').easyAutocomplete({
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
                onShowListEvent: function(term) {
                    var list = $('body').find('#eac-container-top-search ul');
                    if (list.text().indexOf('View All Results') == -1) {
                        list.append('<li id="view-all"><a href="/search/' + term + '/results"><strong>View All Results</strong></a></li>');
                    }
                }
            }
        });
    });
</script>

</html>

