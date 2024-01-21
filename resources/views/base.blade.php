@php
    $routeName = request()->route()->getName();
@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">

    <style>
        @layer demo {
            button {
                all: unset;
            }
        }
    </style>

    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Devloop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' =>  str_starts_with($routeName,'blog.')])
                       href="{{route('blog.index')}}">Blog</a>
                </li>
            </ul>
            <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    <form class= "nav-item" action="{{route('auth.logout')}}" method="post">
                        @method('delete')
                        @csrf
                        <button class="nav-link">Logout</button>
                    </form>
                @endauth
                @guest
                    <div class="nav-item">
                        <a class="nav-link" href="{{route('auth.login')}}">Connection</a>
                    </div>

                @endguest
            </div>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>

    @endif
    @yield('content')
</div>
</body>
</html>
