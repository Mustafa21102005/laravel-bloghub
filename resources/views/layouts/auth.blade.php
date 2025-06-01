<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description"
            content="Welcome to Mustafa's Blog - A place to share knowledge, insights, and stories." />
        <meta name="author" content="Mustafa" />
        <meta name="keywords" content="Blog, Mustafa, Laravel, PHP, Web Development" />

        {{-- csrf-token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Blog - @yield('title')</title>

        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('theme/assets/favicon.ico') }}" />

        {{-- Phosphor Icons --}}
        <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2"></script>

        {{-- Google Fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
            type="text/css" />
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
            rel="stylesheet" type="text/css" />

        {{-- jQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        {{-- Theme CSS --}}
        <link href="{{ asset('theme/css/styles.css') }}" rel="stylesheet" />

        <style>
            #authNav {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                border-bottom: 1px solid #dee2e6;
                background-color: #fff;
                font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }

            #authNav .navbar-brand {
                font-weight: 800;
            }

            #authNav .navbar-toggler {
                font-size: 0.75rem;
                font-weight: 800;
                padding: 0.75rem;
                text-transform: uppercase;
            }

            #authNav .navbar-nav>li.nav-item>a.nav-link {
                font-size: 0.75rem;
                font-weight: 800;
                letter-spacing: 0.0625em;
                text-transform: uppercase;
            }

            main {
                padding-top: 100px;
            }
        </style>

        @yield('css')
    </head>

    <body>
        {{-- Navigation --}}
        <nav class="navbar navbar-expand-lg navbar-light" id="authNav">
            <div class="container">
                <a class="navbar-brand" href="{{ route('posts.index') }}">Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ph-bold ph-list"></i>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
                    <x-navbar-auth />
                </div>
            </div>
        </nav>

        {{-- Page Content --}}
        <main class="container mt-4">
            @yield('content')
        </main>

        {{-- JS Scripts --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('theme/js/scripts.js') }}"></script>

        @yield('js')
    </body>

</html>
