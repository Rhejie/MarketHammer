<?php

Route::group(['prefix' => 'audit-trail'], function() {
    Route::resource('/', 'AuditTrailController');
});