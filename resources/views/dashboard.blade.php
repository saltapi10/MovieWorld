<x-app-layout>

    <div class="col-md-12 row">
        <div class="col-md-10">

            <h2>Movies List</h2>

            <div class="m-5">

                <div class="card shadow-sm mb-5">
                    <div class="card-body">
                        <p class="card-text text-dark">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-5">
                    <div class="card-body text-dark">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>



            </div>

        </div>
        <div class="col-md-2 d-flex flex-column align-items-center justify-content-center">

            @if(!empty($sessionExists))
                <span class="m-3">
                    Welcome back
                        <a href="/user-movies/{{$user_id}}">
                            {{$user_name}}
                        </a>
                </span>
            @endif

            <div class="d-flex">
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
    </div>

</x-app-layout>
