<?php


Route::get('/', function (Request $request) {
    dd($request);
    return redirect('/admin/home');
});

Route::get('/login-iframe', 'Auth\LoginiframeController@login')->name('iframelogin');

//like this?
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

//  Tracking Routes...
Route::get('/track/{img}', 'Admin\TrackingImageController@track');
Route::get('/trackevent/{img}', 'Admin\TrackingImageController@trackEvent');
Route::get('/trackmailing/{img}', 'Admin\TrackingImageController@trackMailing');

//like this? yes, slook there what we do with the data



Route::group(['middleware' => ['auth', 'approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home/chartdata', 'HomeController@getDataForChart');
    Route::get('/home/barchartdata', 'HomeController@barChartData');
    Route::post('updateprofile', ['uses' => 'Admin\UsersController@updateprofile', 'as' => 'users.updateprofile']);
    Route::get('/invoice', 'Admin\InvoiceController@getdata')->name('invoice.getdata');

    Route::post('onetime', 'Admin\UsersController@postOnetime')->name('payment.onetime');


    Route::get('/download_csv', 'HomeController@download_csv')->name('admin.downloadcsv');








    Route::get('/home', 'HomeController@index');
    Route::post('/firstrequest', 'HomeController@firstrequest')->name('firstrequest');
    Route::resource('subscriptions', 'Admin\SubscriptionsController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('payments', 'Admin\PaymentsController');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);
    Route::resource('campaigns', 'Admin\CampaignsController');
    Route::post('campaigns_mass_destroy', ['uses' => 'Admin\CampaignsController@massDestroy', 'as' => 'campaigns.mass_destroy']);
    Route::post('campaigns_restore/{id}', ['uses' => 'Admin\CampaignsController@restore', 'as' => 'campaigns.restore']);
    Route::delete('campaigns_perma_del/{id}', ['uses' => 'Admin\CampaignsController@perma_del', 'as' => 'campaigns.perma_del']);
    Route::resource('requests', 'Admin\RequestsController');
    Route::post('requests_mass_destroy', ['uses' => 'Admin\RequestsController@massDestroy', 'as' => 'requests.mass_destroy']);
    Route::post('requests_restore/{id}', ['uses' => 'Admin\RequestsController@restore', 'as' => 'requests.restore']);
    Route::delete('requests_perma_del/{id}', ['uses' => 'Admin\RequestsController@perma_del', 'as' => 'requests.perma_del']);
    Route::resource('stripe_upgrades', 'Admin\StripeUpgradesController');
    Route::resource('stripe_transactions', 'Admin\StripeTransactionsController');




});
