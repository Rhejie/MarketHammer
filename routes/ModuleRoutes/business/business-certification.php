<?php

Route::match(['post', 'get'], '/business-certification/get-certifications', 'BackOffice\Business\BusinessCertificationController@getCertifications')->name('business-certification.get-certifications');
Route::post('/business-certification/export-certifications', 'BackOffice\Business\BusinessCertificationController@exportCertifications')->name('business-certification.export-certifications');
Route::match(['put', 'post'], '/business-certification/{id}', 'BackOffice\Business\BusinessCertificationController@update')->name('business-certification.update');
Route::resource('business-certification', 'BackOffice\Business\BusinessCertificationController');