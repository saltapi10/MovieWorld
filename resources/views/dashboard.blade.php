<x-app-layout>

    <div class="col-md-12 row">
        <div class="col-md-10">

            <h2>{{ $header_data['movies_list_title'] ?? 'Movies List' }}</h2>

            <div class="m-5 overflow-auto" style="height: 70vh;">

                @if(!empty(count($movies)))
                @foreach ($movies as $movie)
                <div class="card shadow-sm mb-5">
                    <div class="card-body">

                        <h3 class="text-dark">{{$movie->title}}</h3>
                        <span class="text-dark">Posted {{date('d-m-Y', strtotime($movie->created_at))}}</span>
                        <p class="card-text text-dark">{{$movie->description}}</p>
                        <div class="d-flex justify-content-between align-items-center reactions_buttons_container">
                            <small class="text-muted"><span class="likes_count">{{!empty($movie->likes) ? $movie->likes : 0}}</span> Likes | <span class="hates_count">{{!empty($movie->hates) ? $movie->hates : 0}}</span> Hates</small>
                            @if($movie->user_id != $user_id)
                            <div class="btn-group">
                                <button type="button" data-reaction="like" data-movie-id="{{$movie->id}}" class="button_reaction button_like btn btn-sm btn-outline-secondary btn-outline-success @if(isset($movies_reactions[$movie->id]) && $movies_reactions[$movie->id] == 'like') btn-success text-white @endif">Like</button>
                                <button type="button" data-reaction="hate" data-movie-id="{{$movie->id}}" class="button_reaction button_hate btn btn-sm btn-outline-secondary btn-outline-danger @if(isset($movies_reactions[$movie->id]) && $movies_reactions[$movie->id] == 'hate') btn-danger text-white @endif">Hate</button>
                            </div>
                            @endif
                            <small class="text-muted">Posted by <a href="/user-movies/{{$movie->user_id}}">{{$movie->user_name}}</a></small>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <div class="card shadow-sm mb-5">
                        <div class="card-body">
                            <p class="card-text text-dark">There are no movies posted</p>
                        </div>
                    </div>
                @endif


            </div>

        </div>
        <div class="col-md-2 d-flex flex-column align-items-center justify-content-start">

            @if(!empty($sessionExists))
                <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#modal-movie-create">
                    Add movie
                </button>
            @endif

            <div class="bg-info rounded mt-5 p-4">
                <h4>Sort by:</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio_sorting" id="radio_likes" value="likes" @if($sort_order_movies == 'likes') checked @endif>
                    <label class="form-check-label" for="radio_likes">
                        Likes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio_sorting" id="radio_hates" value="hates" @if($sort_order_movies == 'hates') checked @endif>
                    <label class="form-check-label" for="radio_hates">
                        Hates
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio_sorting" id="radio_dates" value="dates" @if($sort_order_movies == 'dates') checked @endif>
                    <label class="form-check-label" for="radio_dates">
                        Dates
                    </label>
                </div>
            </div>


        </div>
    </div>

</x-app-layout>
