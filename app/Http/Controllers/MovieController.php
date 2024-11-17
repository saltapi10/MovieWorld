<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieReaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\View as V;

class MovieController extends Controller
{
    /**
     * Handle an incoming movie creation request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request): RedirectResponse
    {

        $user = Auth::user();

        if(!$user){
            return Redirect::route('dashboard')->with('status', 'You are not authorized to add movies!');
        }

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255', 'unique:' . Movie::class],
            'description' => ['required', 'string', 'max:1200'],
        ]);

        if ($validator->fails()) {
            return Redirect::route('dashboard')->with('status', 'Error creating movie. Try again!')
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $movieArray = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $user['id']
        ];

        $movie = Movie::create($movieArray);

        if(!$movie){
            return Redirect::route('dashboard')->with('status', 'Error creating movie. Try again!');
        }

        return Redirect::route('dashboard')->with('status', 'New movie was created');
    }

    public function userMovies($id = 0)
    {
        $user = User::find($id);
        if(!$user){
            return Redirect::route('dashboard')->with('status', 'Wrong user id');
        }

        $headerData = [
            'title' => 'Movies List of ' . $user->name,
            'movies_list_title' => 'Movies List of ' . $user->name,
        ];
        V::share('header_data', $headerData);

        $orderOfMovies = Session::get('orderMovies', 'dates');

        $result = (new Movie())->getAllMovies($id, $orderOfMovies);

        return view('dashboard', [
            'movies' => $result['movies'],
            'movies_reactions' => $result['movies_reactions'],
            'sort_order_movies' => $orderOfMovies
        ]);

    }

    /**
     * Handle an incoming movie reaction request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reaction(Request $request)
    {

        $user = Auth::user();

        if(!$user){
            return Redirect::route('dashboard')->with('status', 'You are not authorized to add reactions!');
        }

        $movieReaction = MovieReaction::where([
            'movie_id' => $request->get('movie_id'),
            'user_id' => $user['id'],
        ])->first();

        if(empty($movieReaction)){
            $reaction = $request->get('reaction_type');

            $checkReactionArray = [
                'user_id' => $user['id'],
                'movie_id' => $request->get('movie_id'),
                'reaction_type' => $reaction
            ];
            $movieReaction = MovieReaction::create($checkReactionArray);

        }else if(!empty($movieReaction) && $request->get('reaction_type') != $movieReaction->reaction_type){
            $reaction = $request->get('reaction_type');

            $checkReactionArray = [
                'reaction_type' => $reaction
            ];
            $movieReaction = MovieReaction::where( 'id', $movieReaction->id)->update($checkReactionArray);

        }else{
            $reaction = 'neutral';

            $checkReactionArray = [
                'id' => $movieReaction->id,
                'reaction_type' => $reaction
            ];
            $movieReaction = MovieReaction::where( 'id', $movieReaction->id)->update($checkReactionArray);
        }

        if(!$movieReaction){
            return json_encode(['message'=>'Error leaving reaction']);
        }

        $movieReactionsLikes = 0;
        $moviesReactionsHates = 0;
        $allReactionsArray = DB::table('movies_reactions')
            ->select('movies_reactions.*')
            ->where('movies_reactions.movie_id', '=', $request->get('movie_id'))
            ->get();

        foreach($allReactionsArray as $generalReaction){
            if($generalReaction->reaction_type == 'like'){
                $movieReactionsLikes++;
            }else if($generalReaction->reaction_type == 'hate'){
                $moviesReactionsHates++;
            }
        }

        return json_encode(['reaction'=>$reaction, 'likes' => $movieReactionsLikes, 'hates'=> $moviesReactionsHates]);
    }

    public function setSortTypeMovies($sort = 'dates')
    {
        Session::put('orderMovies', $sort);
        return redirect()
            ->back()
            ->with('status', 'Order changes to ' . $sort);
    }

}
