<?php

namespace Tests\Unit;

use App\Models\Movie;
use App\Models\User;
use App\Models\MovieReaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoviesTest extends TestCase
{

    //use RefreshDatabase;
    //if we want to keep data created comment out use RefreshDatabase;

    public function test_seeder(){

        // run a seeder for 100 users creating 1 to 5 movies each and reacting to random 1 to 20 of the movies each

        for($i=1;$i<=100;$i++){

            $uniqueIdUser = uniqid();

            $userArray = [
                'name' => 'Name ' . $uniqueIdUser,
                'email' => 'test'.$uniqueIdUser.'@test.com',
                'password' => 'test'
            ];
            $user = User::create($userArray);
        }

        $allUsers = User::all();
        foreach($allUsers as $thisUser){

            for ($i = 0; $i <= rand(1,5); $i++) {// users create 1-5 movies

                $uniqueIdMovie = uniqid();
                $movieArray = [
                    'title' => "Title " . $uniqueIdMovie,
                    'description' => 'Description',
                    'user_id' => $thisUser->id
                ];
                $movie = Movie::create($movieArray);

            }
        }

        foreach($allUsers as $thisUser2){

            $reactionsLimit = rand(1,20); // every user leaves 1-20 reactions in random movies
            $randomMovies = Movie::inRandomOrder()
                ->limit($reactionsLimit)
                ->get();

            foreach($randomMovies as $thisMovie){

                if($thisMovie->user_id == $thisUser2->id){
                    continue;
                }

                $reactionsTypes = [
                    0=>'neutral',
                    1=>'like',
                    2=>'hate'];

                $checkReactionArray = [
                    'user_id' => $thisUser2->id,
                    'movie_id' => $thisMovie->id,
                    'reaction_type' => $reactionsTypes[rand(0,2)]
                ];
                $movieReaction = MovieReaction::create($checkReactionArray);
            }
        }

        $countUsers = count(User::all());
        $countMovies = count(Movie::all());
        $countMovieReactions = count(MovieReaction::all());
        $this->assertEquals(true, is_integer($countUsers));
        echo 'Users are: '.$countUsers;
        $this->assertEquals(true, is_integer($countMovies));
        echo ' Movies are: '.$countMovies;
        $this->assertEquals(true, is_integer($countMovieReactions));
        echo ' Movie Reactions are: '.$countMovieReactions;
    }

    public function test_check_movie_query(){
        $result = (new Movie())->getAllMovies(null, 'likes');
        $this->assertEquals(true, count($result) > 0);
    }
}
