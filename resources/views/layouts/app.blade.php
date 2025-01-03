<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $header_data['title'] ?? config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>
<body class="d-flex h-100 text-center text-white bg-dark">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

<!-- Page Content -->

    <main class="px-3">

        <div class="col-md-12 d-flex justify-content-between flex-row">
            <a class="m-3 d-flex align-items-center" href="/">Movie World</a>

            @if(!empty($sessionExists))
                <span class="m-3 d-flex align-items-center">
                    Welcome back
                        <a class="m-lg-1" href="/user-movies/{{$user_id}}">
                            {{$user_name}}
                        </a>
                </span>
            @endif

            <div class="d-flex m-3 d-flex align-items-center">
                <!-- Buttons trigger modal -->

                @if(empty($sessionExists))
                    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#modal-login">
                        Login
                    </button>

                    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#modal-register">
                        Sign Up
                    </button>
                @endif

                @if(!empty($sessionExists))
                    <form method="POST" action="/logout" class="mx-2">
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>

                    </form>
                @endif
            </div>
        </div>

        @if (!empty(session('status')))
            <div class="bg-white message-alert">
                <p class="mt-2 font-medium text-sm text-dark">
                    {{ session('status') }}
                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="text-dark">:message</div>')) !!}
                    @endif
                </p>
            </div>
        @endif

        <hr>

        {{ $slot }}

        <!-- Modal login -->
        <div class="modal fade" id="modal-login" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-footer">
                        <button type="button" class="close-popup-modal btn btn-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                </svg>
                            </i>
                        </button>
                    </div>
                    <div class="modal-content-frame">
                        @include('auth.login')
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal register -->
        <div class="modal fade" id="modal-register" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-footer">
                        <button type="button" class="close-popup-modal btn btn-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                </svg>
                            </i>
                        </button>
                    </div>
                    <div class="modal-content-frame">
                        @include('auth.register')
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal movie create -->
        <div class="modal fade" id="modal-movie-create" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-footer">
                        <button type="button" class="close-popup-modal btn btn-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                </svg>
                            </i>
                        </button>
                    </div>
                    <div class="modal-content-frame">
                        @include('movie_create')
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
</body>

@vite(['resources/js/app.js'])
</html>
