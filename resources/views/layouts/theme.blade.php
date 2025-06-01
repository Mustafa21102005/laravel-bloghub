<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description"
            content="Welcome to Mustafa's Blog - A place to share knowledge, insights, and stories." />
        <meta name="author" content="Mustafa" />
        <meta name="keywords" content="Blog, Mustafa, Laravel, PHP, Web Development" />

        <title>Blog - @yield('title')</title>

        {{-- csrf-token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- icon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('theme/assets/favicon.ico') }}" />

        {{-- phosphor-icons --}}
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

        @yield('css')
    </head>

    <body>
        {{-- Navigation --}}
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ route('posts.index') }}">Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ph-bold ph-list"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <x-navbar-auth />
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="border-top py-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="small text-center text-muted fst-italic">
                            &copy; <a href="https://wa.me/966545117570" target="_blank">Mustafa</a> Blog 2024<br>
                            Template made by <a href="https://startbootstrap.com/theme/clean-blog" target="_blank">Start
                                Bootstrap</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('theme/js/scripts.js') }}"></script>
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" />

        {{-- js to handle bookmark button --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.bookmark-toggle-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const isAuthenticated = form.dataset.auth === 'true';
                        if (!isAuthenticated) {
                            // Redirect to login if user is not authenticated
                            window.location.href = "{{ route('login') }}";
                            return;
                        }

                        const url = this.action;
                        const icon = this.querySelector('i');

                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.bookmarked) {
                                    icon.classList.remove('ph-bookmark-simple');
                                    icon.classList.add('ph-fill', 'ph-bookmark-simple');
                                } else {
                                    icon.classList.remove('ph-fill');
                                    icon.classList.add('ph', 'ph-bookmark-simple');
                                }
                            });
                    });
                });
            });
        </script>

        @yield('js')
    </body>

</html>
