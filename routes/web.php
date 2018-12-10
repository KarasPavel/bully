<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('account', 'AccountController@index')->name('account');


    Route::get('my_events', 'MyEventsController@index')->name('my_events');
    Route::post('my_events', 'MyEventsController@update');

    //Route::get('event_cart', 'EventCartController@index')->name('event_cart');


    Route::get('personal_information', 'PersonalInformationController@index')->name('personal_information');
    Route::post('personal_information', 'PersonalInformationController@update');
    Route::get('personal_information/notCredentials', 'PersonalInformationController@notCredentials');


    Route::get('create-event','EventController@create')->name('create-event');
    Route::post('create-event', 'EventController@store')->name('create-event');
    Route::get('update-event/{event}', 'EventController@edit')->name('update-event/{event}');
    Route::post('update-event/{id}', 'EventController@update');
    Route::get('delete-event/{id}', 'EventController@destroy')->name('delete-event/{id}');
});
Auth::routes();

Route::post('current-sell-sum', 'AccountController@currentSellSum');
Route::post('event-filter', 'AccountController@eventFilter');

Route::get('/', 'IndexController@index')->name('/');
Route::post('search', 'IndexController@search');
Route::get('search', 'IndexController@search')->name('search');
Route::get('found-events', 'IndexController@foundEvents')->name('found-events');
Route::get('buy-ticket', 'BuyTicketController@index')->name('buy-ticket');
Route::post('save-ticket', 'BuyTicketController@saveTicket');
Route::get('create-account', 'CreateAccountController@index')->name('create-account');
Route::get('login-to-account', 'LoginToAccountController@index')->name('login-to-account');
Route::get('forgot-password', 'UserController@forgotPassword')->name('forgot-password');
Route::get('not-valid-email', 'UserController@notValidEmail')->name('not-valid-email');

Route::get('event', 'EventController@index')->name('event');
Route::get('news', 'EventController@news')->name('news');
Route::get('event/{event}', 'EventController@show')->name('event/{event}');
Route::get('event_hall/{id}', 'EventController@eventHall')->name('event_hall/{id}');
Route::get('getEvent', 'EventController@getEvent');
Route::post('edit-image', 'EventController@editImage');
Route::post('sorting-events', 'EventController@sortingEventsByCategories');
Route::post('sorting-events-by-date', 'EventController@sortingEventsByDate');
Route::post('sales-places', 'EventController@salesPlaces');

Route::get('admin/view-hall/{id}', 'HallController@show')->name('admin/view-hall/{id}');
Route::post('checkHall', 'HallController@checkHall');
Route::post('/getHalls', 'HallController@getHalls');
Route::post('/selectHall', 'HallController@selectHall');
Route::get('/goHall', 'HallController@goHall');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');


Route::post('admin/cinema-management/hall/create-sector', 'SectorController@store');
Route::post('/create-sector', 'SectorController@store');
Route::post('/get-sector', 'SectorController@getSector');
Route::post('select-sector', 'SectorController@selectSector');


Route::group(['middleware' => ['is_admin','auth'] ], function () {

    Route::get('admin', 'AdminController@admin')->name('admin');
    Route::get('hall/{id}', 'AdminController@showHall')->name('hall/{id}');


    Route::get('admin/cinema-management/hall-management', 'HallController@index')->name('admin/cinema-management/hall-management');
    Route::get('admin/cinema-management/hall', 'HallController@create')->name('admin/cinema-management/hall');
    Route::get('admin/cinema-management/hall/create-hall', 'HallController@createHall')->name('admin/cinema-management/hall/create-hall');
    Route::post('admin/cinema-management/hall/create-hall/{id}', 'HallController@store');


    Route::get('admin/user-management', 'UserController@index')->name('admin/user-management');
    Route::get('admin/user-management/create-user', 'UserController@createAccount')->name('admin/user-management/create-user');

    Route::get('admin/event-management', 'AdminEventController@index')->name('admin/event-management');
    Route::get('admin/create-event', 'EventController@create')->name('admin/create-event');
    Route::get('admin/edit-event', 'EventController@edit')->name('admin/edit-event');


    Route::get('admin/cinema-management', 'CinemaController@index')->name('admin/cinema-management');
    Route::get('admin/cinema-management/create-cinema', 'CinemaController@create')->name('admin/cinema-management/create-cinema');
    Route::post('admin/cinema-management/create-cinema', 'CinemaController@store')->name('admin/cinema-management/create-cinema');
    Route::get('admin/cinema-management/edit-cinema/{id}', 'CinemaController@edit')->name('admin/cinema-management/edit-cinema/{id}');
    Route::post('admin/cinema-management/edit-cinema/{id}', 'CinemaController@update');
    Route::get('admin/cinema-management/cinema/{id}', 'CinemaController@show')->name('admin/cinema-management/cinema/{id}');


    Route::get('admin/cinema-management/hall/sector', 'SectorController@index')->name('admin/cinema-management/hall/sector');
    Route::get('admin/cinema-management/hall/create-sector', 'SectorController@create')->name('admin/cinema-management/hall/create-sector');


    Route::get('admin/cinema-management/hall/row', 'RowController@index')->name('admin/cinema-management/hall/row');
    Route::get('admin/cinema-management/hall/place', 'PlaceController@index')->name('admin/cinema-management/hall/place');

});


Route::get('/subscribe/paypal', 'PaypalController@paypalRedirect')->name('paypal.redirect');
Route::get('/subscribe/paypal/return', 'PaypalController@paypalReturn')->name('paypal.return');
Route::post('payWithpaypal', 'PaypalController@payWithpaypal');
Route::get('status', 'PaypalController@getPaymentStatus')->name('status');
Route::get('paypal-error', 'PaypalController@paypalError')->name('paypal-error');


Route::get('ticket', 'BuyTicketController@getTicket')->name('ticket');


Route::get('barcode', 'HomeController@barcode');

Route::post('sendTicket', 'MailController@sendTicket');
Route::post('send-password', 'MailController@sendPassword');

Route::post('set-session', 'BuyTicketController@setSession');
Route::post('get-session', 'BuyTicketController@getSession');

Route::post('subscribing-mailchimp', 'MailchimpController@subscribing');

Route::get('auth/google', 'Auth\LoginController@redirectToProvider')->name('auth/google');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback')->name('auth/google/callback');

Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook')->name('auth/facebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback')->name('auth/facebook/callback');

Route::get('auth/vk', 'Auth\LoginController@redirectToVK')->name('auth/vk');
Route::get('auth/vk/callback', 'Auth\LoginController@handleVKCallback')->name('auth/vk/callback');


Route::get('parse-feed', 'IndexController@parseFeed')->name('parse-feed');

Route::get('place/{id}', 'CinemaController@showPlace')->name('place/{id}');

Route::get('synchronize', function (){
    include '../DB/synchronize.php';
});

/*Route::get('addImg', function (){
    libxml_use_internal_errors(true);
    //$xml = file_get_contents('https://msk.kassir.ru/frame/feed/xml?key=9b700613-ce77-d1a9-f169-50ee8e9c764f');
    ini_set ( 'memory_limit' , '400M' );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://msk.kassir.ru/frame/feed/xml?key=9b700613-ce77-d1a9-f169-50ee8e9c764f');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip'));
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
    $result = curl_exec($ch);
    $xml = gzinflate(substr($result,10));
    $feed = json_decode(json_encode(simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA)),1);
    //dump($feed);

    set_time_limit(0);
    dump($feed);
});*/
