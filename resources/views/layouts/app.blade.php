<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.2/css/bulma.min.css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.2/css/selectize.bootstrap4.min.css"  />    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.2/js/standalone/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="{{ asset('css/costum.css') }}">

    <!-- Styles -->
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Simple E-Library</h3>
            </div>

            <ul class="list-unstyled components">
                <p><a href="/">Welcome</a></p>
                @auth
                    @if(Level::where("users_id",Auth::user()->id)->first()->level_name == "admin")
                    <li class="active">
                        <a href="#Users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Users</a>
                        <ul class="collapse list-unstyled" id="Users">
                            <li>
                                <a href="{{ route('user_list') }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('user_list') }}/user_add">Add</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="#Author" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Author</a>
                        <ul class="collapse list-unstyled" id="Author">
                            <li>
                                <a href="{{ route('author') }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('author') }}/add">Add</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                @endauth
                <li>
                    <a href="#Books" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Books</a>
                    <ul class="collapse list-unstyled" id="Books">
                    @auth
                        @if(Level::where("users_id",Auth::user()->id)->first()->level_name == "admin")
                        <li>
                            <a href="{{ route('books') }}/add">Add Books</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('books') }}">Books List</a>
                        </li>
                    @endauth
                    </ul>
                </li>

                @auth
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <button class="btn" type="submit"><a>Logout</a></button>
                    <form>
                </li>
                @endauth
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <main class="py-4">
                @yield('content')
            </main>
        </div>


    </div>

    <script>
    $(function() {
        $('#select').selectize();
    });
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>
</html>
