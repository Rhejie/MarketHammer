<?php

Route::group(['prefix' => 'announcement', 'namespace' => 'Home'], function() {
    Route::resource('/', 'AnnouncementController');
    Route::post('/get-user-announcements', 'AnnouncementController@getUserAnnouncements');
    Route::post('/get-announcement', 'AnnouncementController@show');
});