<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/simplemde.min.css">
    <link rel="stylesheet" href="/css/prism.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/easy-autocomplete.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />

    <link rel="stylesheet" href="/css/inspinia.css?v=1.1">
    <link rel="stylesheet" href="/css/app.css?v=1.1">

    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/favicon.ico" type="image/x-icon" />

</head>


<body class="<?php echo env('APP_THEME', 'mayden-skin'); ?> <?php echo session()->get('minimaliseNavbar') ? 'mini-navbar' : null; ?>">
    <div id="app">
        <div id="wrapper">

            @include('partials.navigation.nav-secondary', compact(
                'current',
                'categories',
                'user',
                'drafts'
            ))

            <div id="page-wrapper" class="main-content">
                <div class="row">
                    <nav class="navbar navbar-fixed-top fixed-nav" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">

                            <div class="navbar-minimalize logo-space">
                                <a href="#"><i class="fa fa-cube"></i> <?php echo env('APP_NAME', 'Black Box'); ?></a>
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

                    </nav>
                </div>

                <div>
                    @if(isset($current['page']))
                        <i class="glyphicon glyphicon-bookmark bookmark {{ is_object($current['page']->bookmark) ? 'active' : null }}" title="Click to bookmark this page"></i>
                    @elseif(isset($current['chapter']))
                        <i class="glyphicon glyphicon-bookmark bookmark {{ is_object($current['chapter']->bookmark) ? 'active' : null }}" title="Click to bookmark this chapter"></i>
                    @endif

                    @yield ('content')
                </div>

                <div class="footer">
                    <div>
                        <strong>&copy;</strong> <?php echo env('APP_NAME', 'Black Box'); ?> {{ date('Y') }}
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/js/easyAutocomplete.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://www.draw.io/js/viewer.min.js" type="text/javascript"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>
    <script src="/js/simplemde.min.js"></script>
    <script src="/js/prism.min.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/app.js"></script>

    <script>
        $(document).ready(function() {
            @if(isset($current['chapter']))
                var category = {!! $current['category'] ? $current['category']->id : '""' !!};
                var chapter = {!! $current['chapter'] ? $current['chapter']->id : '""' !!};
                var page = {!! isset($current['page']) ? $current['page']->id : '""' !!};

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
        });

    </script>

</body>

@yield('scripts')

</html>

