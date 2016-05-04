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


<body class="fixed-nav fixed-nav-basic" id="app">
<div id="wrapper">

    <div id="page-wrapper">
        <div class="row">
            <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <div class="logo-space">
                        <a href="/"><i class="fa fa-cube"></i> Black Box</a>
                    </div>
                    <div class="right">
                        <i class="minimalize-styl-2 glyphicon glyphicon-search bigger-icon"></i>
                        <form role="search" class="navbar-form-custom" method="post" action="#">
                            <div class="form-group">
                                <input type="text" placeholder="Search.." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="right topbar-icons">
                    <a href="/random" title="Take me to a random page"><i class="fa fa-random"></i></a>
                </div>
            </nav>

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li{!! Request::is('/') ? ' class="active"' : null !!}>
                            <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
                        </li>

                        @foreach($categories as $category)
                            @if($current['category'] != null)
                                <li{!! $current['category']->id == $category->id ? ' class="active"' : null !!}>
                            @else
                                <li>
                            @endif
                                <a href="/p/{{ $category->slug }}">
                                    <i class="fa fa-book"></i>
                                    <span class="nav-label">{{ $category->title }}</span>
                                    @if(is_object($category->chapters))
                                        <span class="fa arrow"></span>
                                    @endif
                                </a>


                                @if(is_object($category->chapters))
                                    <ul class="nav nav-second-level collapse">
                                        @foreach($category->chapters as $chapter)
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
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <li{!! Request::is('/bookmarks') ? ' class="active"' : null !!}>
                            <a href="/bookmarks"><i class="glyphicon glyphicon-bookmark"></i> <span class="nav-label">Your Bookmarks (<span id="bookmark-count">{{ $bookmarks }}</span>)</span></a>
                        </li>
                    </ul>

                </div>
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

    </div>
</div>

<!-- Main scripts -->
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/js/inspinia.js"></script>
<script src="/js/easyAutocomplete.js"></script>
<script src="/js/plugins/pace/pace.min.js"></script>

@yield('scripts')

<script>
    $(document).ready(function() {

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
                maxNumberOfElements: 10
            }
        });
    });
</script>

</body>

</html>

