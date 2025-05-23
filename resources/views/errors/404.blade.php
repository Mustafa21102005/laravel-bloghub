<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags --}}

    <title>404</title>

    {{-- Google fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">

    {{-- Custom CSS --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('theme/404/css/style.css') }}" />

    {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    WARNING: Respond.js doesn't work if you view the page via file://
    [if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif] --}}
    </head>

    <body>

        <div id="notfound">
            <div class="notfound">
                <div class="notfound-404">                    
                    <h3>Oops! Page not found</h3>
                    <h1 class="shine"><span>4</span><span>0</span><span>4</span></h1>
                </div>
                <h2 class="funny-text">
                    Where are we bro?
                    <span class="emoji"><img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f630/512.gif" width="32"></span>
                </h2>                  
                <a href="{{ route('posts.index') }}">Back to Home</a>
            </div>
        </div>

        {{-- This templates was made by Colorlib (https://colorlib.com)  --}}
    </body>

</html>