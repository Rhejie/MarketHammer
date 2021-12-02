<?php

Route::match(['post', 'get'], 'user-token/get-password-tokens', 'BackOffice\User\UserTokenController@getPasswordTokens')->name('user-token.get-password-tokens');
Route::match(['post', 'get'], 'user-token/get-personal-tokens', 'BackOffice\User\UserTokenController@getPersonalTokens')->name('user-token.get-personal-tokens');
Route::delete('user-token/revoke-token/{user_token}', 'BackOffice\User\UserTokenController@revokeToken')->name('user-token.revoke-token');
Route::resource('user-token', 'BackOffice\User\UserTokenController');