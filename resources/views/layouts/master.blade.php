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

    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
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
                        <i class="glyphicon glyphicon-unchecked"></i> Black Box
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
            </nav>

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li{!! Request::is('/') ? ' class="active"' : null !!}>
                            <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
                        </li>
                        @foreach($chapters as $chapter)
                            <li{!! Request::segment(2) == $chapter->slug ? ' class="active"' : null !!}>
                                <a href="/chapter/{{ $chapter->slug }}">
                                    <i class="glyphicon glyphicon-book"></i>
                                    <span class="nav-label">{{ $chapter->title }}</span>
                                    @if(!$chapter->pages->isEmpty())
                                        <span class="fa arrow"></span>
                                    @endif
                                </a>
                                @if(!$chapter->pages->isEmpty())
                                    <ul class="nav nav-second-level collapse">
                                        @foreach($chapter->pages as $page)
                                            <li><a href="/chapter/{{ $chapter->slug }}/{{ $page->slug }}">{{ $page->title }}</a></li></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                </div>
            </nav>
        </div>

        <div class="row row-first-content">
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
            }
        });
    });
</script>

</body>

</html>

