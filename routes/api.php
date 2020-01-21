<?php

use Illuminate\Http\Request;

Route::post('/lectures', 'Api\LectureController@store');
Route::get('/lectures/{lecture}', 'Api\LectureController@show');
