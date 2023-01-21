<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/test', function () {

    $response = Http::post( "http://l.graphql.test/graphql", [
        'query' => '
                   query{
                        posts
                        {
                              paginatorInfo{
                                count
                                currentPage
                                perPage
                                total

                              }
                              data{
                                id
                                title
                                body
                              }
                        }
                      }
                  ',
    ] );

    return view('welcome', ['posts' => $response->json()['data']['posts']['data']]);
} );


Route::get( '/create', function () {

     Http::post( "http://l.graphql.test/graphql", [
        'query' => '
                 mutation{
                      createPostResolver(
                        user_id : "1",
                        title : "Hello From laravel  ",
                        body : "content from laravel",
                      ){
                        title
                        body
                        id
                      }
                }
                  ',
    ] );

    return redirect(url('/test'));
} );
