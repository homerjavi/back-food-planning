<?php

use App\Models\Category;
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

Route::post('account', 'AccountController@store')->name( 'account.store' );

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
});


Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
    Route::post('updateUser', 'AuthController@update');
    Route::post('uploadAvatar', 'AuthController@uploadAvatar');


    // Route::apiResource( 'categories', 'CategoryController' )->except('show')->middleware( 'can:update,delete' );
    Route::get( 'categories', 'CategoryController@index' )->name( 'categories.api' );
    Route::post( 'categories', 'CategoryController@store' )->name( 'categories.store.api' );
    Route::patch( 'categories/{category}', 'CategoryController@update' )->name( 'categories.update.api' );
    Route::delete( 'categories/{category}', 'CategoryController@destroy' )->name( 'categories.destroy.api' );

    Route::get( 'meals', 'MealController@index' )->name( 'meals.api' );
    Route::post( 'meals', 'MealController@store' )->name( 'meals.store.api' );
    Route::patch( 'meals/{meal}', 'MealController@update' )->name( 'meals.update.api' );
    Route::delete( 'meals/{meal}', 'MealController@destroy' )->name( 'meals.destroy.api' );
    
    Route::get( 'mealHours', 'MealHourController@index' )->name( 'mealHours.index.api' );
    Route::post( 'mealHours', 'MealHourController@store' )->name( 'mealHours.store.api' );
    Route::patch( 'mealHours/{mealHour}', 'MealHourController@update' )->name( 'mealHours.update.api' );
    Route::delete( 'mealHours/{mealHour}', 'MealHourController@destroy' )->name( 'mealHours.destroy.api' );

    Route::get( 'mealTypes', 'MealTypeController@index' )->name( 'mealTypes.index.api' );
    Route::post( 'mealTypes', 'MealTypeController@store' )->name( 'mealTypes.store.api' );
    Route::patch( 'mealTypes/{mealType}', 'MealTypeController@update' )->name( 'mealTypes.update.api' );
    Route::delete( 'mealTypes/{mealType}', 'MealTypeController@destroy' )->name( 'mealTypes.destroy.api' );

    Route::get( 'planning', 'PlanningController@index' )->name( 'planning.api' );
    Route::post( 'planning', 'PlanningController@store' )->name( 'planning.store.api' );
    Route::post( 'updateMealType', 'PlanningController@updateMealType' )->name( 'planning.updateMealType.api' );
    Route::post( 'updateOrderPlanning', 'PlanningController@updateOrderPlanning' )->name( 'planning.updateOrder.api' );
    Route::delete( 'planning/{planning}', 'PlanningController@destroy' )->name( 'planning.delete.api' );
});



/* Route::group(['middleware' => ['cors']], function () {
    Route::get( 'meals', 'MealController@index' )->name( 'meals.api' );
});
 */
