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
    Route::post('/link', 'LinkController');
    Route::post('/email', 'EmailAuthController');

    Route::group(['namespace'=>'User', 'prefix'=>'users'], function(){
        Route::get('/leaders/', 'IndexController');
        Route::post('/', 'StoreController');

    });
    Route::group(['namespace'=>'Team', 'prefix'=>'teams'], function(){
        Route::get('/leaders/', 'LeadersController');

    });
    Route::group(['namespace'=>'Quest', 'prefix'=>'quests'], function(){
        Route::get('/', 'IndexController');
//        Route::post('/', 'StoreController');
    });
    Route::group(['namespace'=>'News', 'prefix'=>'news'], function(){
            Route::get('/', 'IndexController');
    });
    Route::group(['namespace'=>'Question', 'prefix'=>'questions'], function(){
            Route::get('/', 'IndexController');
    });

    //authorized
    Route::group(['middleware'=>['jwt.auth','block']], function(){
        Route::group(['namespace'=>'Quest', 'prefix'=>'quests'], function(){
            Route::post('/', 'StoreController');
            Route::get('/{quest}', 'QuestShowController');
            Route::get('/{quest}/edit', 'EditController');
            Route::post('/{quest}', 'UpdateController');
        });
        Route::group(['namespace'=>'Task', 'prefix'=>'tasks'], function(){
//            Route::get('/', 'IndexController');
            Route::post('/', 'StoreController');
            Route::get('/{task}/edit', 'EditController');
            Route::patch('/{task}', 'UpdateController');
        });
        Route::group(['namespace'=>'Category', 'prefix'=>'categories'], function(){
//            Route::get('/', 'IndexController');
            Route::post('/', 'StoreController');
            Route::get('/{task}/edit', 'EditController');
            Route::post('/update', 'UpdateController');
        });
        Route::group(['namespace'=>'User', 'prefix'=>'users'], function(){
            Route::get('/', 'ShowController');
            Route::get('/score', 'ScoreController');
            Route::get('/started_at', 'StartedController');
            Route::patch('/password', 'PasswordUpdateController');
            Route::patch('/data', 'DataUpdateController');

            Route::group([ 'prefix'=>'quest'], function(){
            Route::get('/{quest}', 'QuestStartController');
            Route::get('/', 'QuestIndexController');
            Route::post('/done', 'QuestDoneController');
            Route::get('/cancel/{quest}', 'QuestCancelController');
            });

            Route::group([ 'prefix'=>'task'], function(){
                Route::post('/check', 'TaskCheckController');
                Route::post('/', 'StartTaskController');
//                Route::get('/cancel/{quest}', 'QuestCancelController');
            });

            Route::group([ 'prefix'=>'hint'], function(){
                Route::post('/', 'HintUseController');
//                Route::get('/cancel/{quest}', 'QuestCancelController');
            });

            Route::group([ 'prefix'=>'photo'], function(){
            Route::post('/', 'PhotoStoreController');
            Route::post('/choose', 'PhotoChooseController');

        });
        });
        Route::group(['namespace'=>'Team', 'prefix'=>'teams'], function(){

            Route::post('/task', 'StartTaskController');
            Route::post('/task/check', 'TaskCheckController');
            Route::post('/', 'StoreController');
            Route::post('/join', 'JoinController');
            Route::get('/quit', 'QuitController');
            Route::post('/quit', 'UserDeleteController');
            Route::get('/{team}', 'ShowController');
            Route::get('admin/{team}', 'AdminController');
            Route::post('/add', 'AddController');
            Route::get('/score', 'ScoreController');

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
            Route::group(['namespace' => 'Picture', 'prefix' => 'pictures'], function () {
                Route::post('/', 'StoreController');
                Route::delete('/{picture}', 'DeleteController');
                Route::get('/', 'IndexController');
            });
            Route::group(['namespace' => 'Photo', 'prefix' => 'photos'], function () {
                Route::delete('/{user}', 'DeleteController');
                Route::get('/', 'IndexController');
            });
        });

        Route::group(['namespace'=>'News', 'prefix'=>'news'], function(){
            Route::post('/', 'StoreController');
//            Route::get('/', 'IndexController');
            Route::get('/{news}/edit', 'EditController');
            Route::patch('/{news}', 'UpdateController');
            Route::delete('/{news}', 'DeleteController');
        });
        Route::group(['namespace'=>'Question', 'prefix'=>'questions'], function(){
            Route::post('/', 'StoreController');
//            Route::get('/', 'IndexController');
            Route::get('/{question}/edit', 'EditController');
            Route::patch('/{question}', 'UpdateController');
            Route::delete('/{question}', 'DeleteController');
        });
        Route::group(['namespace'=>'Qr', 'prefix'=>'qrs'], function(){
            Route::get('/{task}', 'ShowController');
            Route::get('/', 'CreateController');
        });
    });

});

