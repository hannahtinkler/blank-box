<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo env('APP_NAME', 'Black Box'); ?> | Access Denied</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg mayden-skin">


    <div class="middle-box text-center animated fadeInDown">
        <h1>Sorry</h1>
        <h3 class="font-bold">You don't have access to this resource.</h3>

        <div class="error-desc m-t-xl">
            Please make sure you are logged into Google Plus/Mail with a '@mayden.co.uk' account.
            Try again? <br/><a href="/login" class="btn btn-primary m-t">Login</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
