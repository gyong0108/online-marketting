<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('campaigns', 'CampaignsController', ['except' => ['create', 'edit']]);

        Route::resource('requests', 'RequestsController', ['except' => ['create', 'edit']]);

});
