<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    public function getAllMovies($userId = null, $orderBy = 'dates'){

        $allMoviesReactionsLikes = [];
        $allMoviesReactionsHates = [];
        $allReactionsArray = DB::table('movies_reactions')
            ->select('movies_reactions.*')
            ->get();

        foreach($allReactionsArray as $generalReaction){

            // initialize indexes
            if(!isset($allMoviesReactionsLikes[$generalReaction->movie_id])){
                $allMoviesReactionsLikes[$generalReaction->movie_id] = 0;
            }
            if(!isset($allMoviesReactionsHates[$generalReaction->movie_id])){
                $allMoviesReactionsHates[$generalReaction->movie_id] = 0;
            }

            if($generalReaction->reaction_type == 'like'){
                $allMoviesReactionsLikes[$generalReaction->movie_id]++;
            }else if($generalReaction->reaction_type == 'hate'){
                $allMoviesReactionsHates[$generalReaction->movie_id]++;
            }
        }

        $userReactions = [];
        if(Auth::user()){
            $userReactionsArray = DB::table('movies_reactions')
                ->select('movies_reactions.*')
                ->where('movies_reactions.user_id', '=' , Auth::id())
                ->get();

            foreach($userReactionsArray as $reaction){
                $userReactions[$reaction->movie_id] = $reaction->reaction_type;
            }
        }

        $movies = DB::table('movies')
            ->select('movies.*',
                'users.name as user_name'
            )
            ->join('users', 'users.id', '=', 'movies.user_id')
        ;

        $movies->orderBy('movies.created_at', 'DESC');

        if(!empty($userId)){
            $movies->where('movies.user_id','=',$userId);
        }

        $allMovies = $movies->get();

        foreach($allMovies as $key=>$movieReacted){

            if(!isset($allMovies[$key]) || !isset($allMoviesReactionsLikes[$movieReacted->id])){
                $allMovies[$key]->likes = 0;
                $allMovies[$key]->hates = 0;
            }else{
                $allMovies[$key]->likes = $allMoviesReactionsLikes[$movieReacted->id];
                $allMovies[$key]->hates = $allMoviesReactionsHates[$movieReacted->id];
            }
        }

        if($orderBy == 'likes'){
            $collectionMovies = collect($allMovies);
            $allMovies = $collectionMovies->sortBy('likes',SORT_REGULAR, true);
        }else if($orderBy == 'hates'){
            $collectionMovies = collect($allMovies);
            $allMovies = $collectionMovies->sortBy('hates',SORT_REGULAR, true);
        }

        $result = [
            'movies' => $allMovies,
            'movies_reactions' => $userReactions,
        ];

        return $result;
    }
}
