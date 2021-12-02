<?php

Route::group(['prefix' => 'events', 'namespace' => 'Home'], function() {
    Route::post('get-events-data', 'EventController@getEvents');
    Route::post('get-events-medias', 'EventController@getEventMedias');
    
});