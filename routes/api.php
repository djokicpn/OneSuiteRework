<?php

use App\Http\Resources\IngredientResource;
use App\Item;
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

//Route::get('posts', 'Api\\PostController@index');

Route::get('categories',        'Api\\CategoryController@index');
//Route::post(    'post',              'App\\PostController@store');
Route::post('posts', 'Api\\PostController@store');
Route::get('posts/search',      'Api\\PostController@getFilteredPosts');
Route::get('posts/filter',      'Api\\PostController@getPosts');

Route::get('ingredients/list',      'Api\\IngredientController@listAll');
Route::post('ingredients/save',      'Api\\IngredientController@save');
Route::post('ingredients/delete',      'Api\\IngredientController@delete');
Route::post('ingredients/update-field', 'Api\IngredientController@updateField');

Route::get('ingredients/search',      'Api\\IngredientController@searchIngredients');


Route::get('countries/list', "Api\\CountryController@list");

Route::get('ingredients/item',      function (Request $request) {
    return response()->json(IngredientResource::collection(Item::find(1)->rawIngredients));
});
Route::get('ingredients/json',      function (Request $request) {
    $toRet = [];

    $ing = new stdClass;
    $ing->name = 'Main Ingredient';
    $ing->percentage = '15';
    $ing->supplier = 'My Supplier';
    $ing->supplier_location = "NW 109th 33513, Miami, FL";
    $ing->origin_country = '1';
    $ing->compound = [
        ['name' => 'Regular Oil', 'percentage' => 11, 'supplier' => 'David Jones'], ['name' => 'Olive Oil', 'percentage' => 25]
    ];

    array_push($toRet, $ing);

    $ing = new stdClass;
    $ing->name = 'Main Ingredient 1';
    $ing->percentage = '15';
    $ing->compound = [
        ['name' => 'Baby Oil', 'percentage' => 39],
        ['name' => 'Baby Soup', 'percentage' => 31],
        ['name' => 'Baby Snacks', 'percentage' => 3]
    ];

    array_push($toRet, $ing);


    return response()->json($toRet, '200');
});

Route::apiResource('posts', 'Api\\PostController');
//Route::post('posts/delete','Api\\PostController@destroy');
