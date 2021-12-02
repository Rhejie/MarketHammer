<?php

Route::group(['prefix' => 'review', 'namespace' => 'Home'], function() {
    Route::post('/save-review', 'ReviewController@saveReview');
});