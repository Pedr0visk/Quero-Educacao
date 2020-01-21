<?php

use Illuminate\Http\Request;

Route::post('/lectures', 'LectureController@store');
Route::get('/lectures/{lecture}', 'LectureController@show');
