<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group([
    'namespace'=>'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {


    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('/google/login', 'GoogleStoreController');

    Route::group(['namespace'=>'User', 'prefix'=>'users'], function(){
        Route::get('/leaders/', 'IndexController');
        Route::post('/', 'StoreController');

    });
    Route::group(['namespace'=>'Quest', 'prefix'=>'quests'], function(){
        Route::get('/', 'IndexController');
//        Route::post('/', 'StoreController');
    });


    //authorized
    Route::group(['middleware'=>'jwt.auth'], function(){
        Route::group(['namespace'=>'Quest', 'prefix'=>'quests'], function(){
            Route::post('/', 'StoreController');
            Route::get('/{quest}/edit', 'EditController');
            Route::patch('/{quest}', 'UpdateController');
        });
        Route::group(['namespace'=>'Task', 'prefix'=>'tasks'], function(){
//            Route::get('/', 'IndexController');
            Route::post('/', 'StoreController');
            Route::get('/{task}/edit', 'EditController');
            Route::patch('/{task}', 'UpdateController');
        });
        Route::group(['namespace'=>'Hint', 'prefix'=>'hints'], function(){
//            Route::get('/', 'IndexController');
            Route::post('/', 'StoreController');
        });
        Route::group(['namespace'=>'User', 'prefix'=>'users'], function(){
            Route::get('/', 'ShowController');

            Route::group([ 'prefix'=>'quest'], function(){
            Route::get('/{quest}', 'QuestShowController');
            Route::post('/done', 'QuestDoneController');
            Route::get('/cancel/{quest}', 'QuestCancelController');
            });

            Route::group([ 'prefix'=>'task'], function(){
                Route::post('/check', 'TaskCheckController');
                Route::post('/', 'StartTaskController');
//                Route::get('/cancel/{quest}', 'QuestCancelController');
            });

            Route::group([ 'prefix'=>'photo'], function(){
            Route::post('/', 'PhotoStoreController');

        });
        });
        Route::group(['namespace'=>'Team', 'prefix'=>'teams'], function(){

            Route::post('/task', 'StartTaskController');
            Route::post('/', 'StoreController');
            Route::post('/join', 'JoinController');
            Route::get('/quit', 'QuitController');
            Route::post('/quit', 'UserDeleteController');
            Route::get('/{team}', 'ShowController');
            Route::get('admin/{team}', 'AdminController');
            Route::get('admin/change/{user}', 'AdminChangeController');

            Route::group(['namespace'=>'Quest', 'prefix'=>'quest'], function(){
                Route::get('/{quest}', 'QuestShowController');
                Route::post('/done', 'QuestDoneController');
                Route::get('/cancel/{quest}', 'QuestCancelController');
            });
        });
        Route::group(['namespace'=>'Admin', 'prefix'=>'admin'], function(){
            Route::group(['namespace'=>'Quest', 'prefix'=>'quests'], function(){
                Route::get('/', 'IndexAdminController');
                Route::get('/hide/{quest}', 'HideController');
                Route::get('/open/{quest}', 'OpenController');
            });
        });
    });

});

