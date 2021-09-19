<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get( 'categories', 'CategoryController@index' )->name( 'categories.api' );
Route::post( 'categories', 'CategoryController@store' )->name( 'categories.store.api' );
Route::get( 'meals', 'MealController@index' )->name( 'meals.api' );
Route::post( 'meals', 'MealController@store' )->name( 'meals.store.api' );
Route::patch( 'meals/{meal}', 'MealController@update' )->name( 'meals.update.api' );
Route::delete( 'meals/{meal}', 'MealController@destroy' )->name( 'meals.destroy.api' );

Route::get( 'planning', 'PlanningController@index' )->name( 'planning.api' );
Route::post( 'planning', 'PlanningController@store' )->name( 'planning.store.api' );
Route::delete( 'planning/{planning}', 'PlanningController@destroy' )->name( 'planning.delete.api' );
Route::delete( 'delete-all-planning', 'PlanningController@deleteAll' )->name( 'planning.delete-all.api' );



/* Route::group(['middleware' => ['cors']], function () {
    Route::get( 'meals', 'MealController@index' )->name( 'meals.api' );
});
 */
