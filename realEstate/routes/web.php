<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//test routes here

//end test routes

//authntication routes
Route::get('test',function (){
    return view('calender');
});
Auth::routes();
Route::post('/loginAdmin', 'Auth\LoginController@loginViaEmailAdmin')->name('loginAdmin');
Route::post('/', 'Auth\LoginControllerUser@loginViaEmail')->name('loginUser');
Route::post('/registerUser', 'Auth\RegisterController@create')->name('registerUser');
Route::get('/UserRegister', function(){
    return view('website\frontend\Registration');})->name('UserRegister');
Route::get('/UserLogin', function(){
    return view('website\frontend\login');
})->name('userLogin');

Route::get('/s', function(){
    return view('website\frontend\customer\calender');
});

//Customer Routes with middleware
Route::group(['middleware' => 'auth.user'], function () {
Route::get('/', 'CustomerHomeController@index')->name('CustomerHome');
//Customer HOMEpage
Route::get('/CustomerHome', 'CustomerHomeController@index');
Route::get('/search_by_place','CustomerHomeController@findItemInState');
Route::get('/search_by_placedate','CustomerHomeController@findItemInStateAndDate');

//Customer Comment
Route::get('/add_comment', 'CommentsController@create')->name('comment.add');
Route::get('/add_reply', 'CommentsController@reply')->name('reply.add');
Route::get('/addReview', 'ReviewController@create')->name('review.add');


//operations
Route::get('/Payment', 'OperationsController@calculateDays')->name('calculate.days');
Route::get('/operation_func','OperationsController@create');
//Payment
Route::get('/creditCard', function(){

    return view('website.frontend.customer.Reservation');

});
Route::post('reserve','PaymentController@create');
Route::get('/reservejj', function () {
    return view('website\backend.database pages.add-Reservation');
});



//items Profile Pages
Route::get('/itemProfile/{id?}', 'CustomerHomeController@itemProfile');
Route::get('/itemDetails/{id?}', 'CustomerHomeController@itemDetails');
Route::get('/itemGallery/{id?}', 'CustomerHomeController@itemProfileGallery');
Route::get('/itemReviews/{id?}', 'CustomerHomeController@itemProfileReviews');

Route::get('/veiw_notification/{id}', 'NotificationController@viewNotification');
});
Route::get('/operationtypes', function () {
    return view('website\backend.database pages.operationTypes');
});
//fullcalender
Route::get('fullcalendar','FullCalendarController@index');
Route::post('fullcalendar/create','FullCalendarController@create');
Route::post('fullcalendar/update','FullCalendarController@update');
Route::post('fullcalendar/delete','FullCalendarController@destroy');

//Admin Routes with middleware
// Route::group(['middleware' => 'auth.admin'], function () {
    Route::get('/openDetail', 'OperationsController@index');
    Route::get('/show_detailop', 'OperationsController@showDetail')->name('detailop_show');
    Route::post('/add_opDetail', 'OperationsController@createDetail');
    Route::delete('/delete_operation_Detail', 'OperationsController@destroyDetail');
    Route::get('/edit_operation_detail', 'OperationsController@editDetail')->name('operationdetail.update');

    Route::get('/test/{id}', 'NotificationController@index');
    Route::get('/data_types', 'DatatypeController@index');
    //main types pages
    Route::get('/main_types', 'MainTypes@index');
    Route::get('/main_types_show', 'MainTypes@show')->name('main_types_show');
    Route::post('/add_main_type', 'MainTypes@create');
    Route::delete('/delete_main_type', 'MainTypes@destroy');
    Route::get('/edit_main_type', 'MainTypes@edit')->name('Maintype.update');
//operation types
Route::get('/operation_types', 'OperationsController@index');
Route::get('/operation_types_show', 'OperationsController@showDetail')->name('operation_types_show');
Route::post('/add_operation_type', 'OperationsController@createType');
Route::delete('/delete_operation_type', 'OperationsController@destroy');
Route::get('/edit_operation_type', 'OperationsController@edit')->name('operationType.update');

    //sub types pages
    Route::get('/sub_types', 'SubTypes@index');
    Route::get('/sub_types_show', 'SubTypes@show')->name('subtype_show');
    Route::post('/add_sub_type', 'SubTypes@create');
    Route::delete('/delete_sub_type', 'SubTypes@destroy');

    //User types pages
    Route::get('/user_types', 'UserTypes@index');
    Route::post('/add_user_type', 'UserTypes@create');
    Route::get('/user_types_show', 'UserTypes@show')->name('usertype_show');
    Route::delete('/delete_user_type/{id?}', 'UserTypes@destroy');
    Route::get('/edit_user_type', 'UserTypes@edit')->name('usertype.edite');

    //Data types pages
    Route::get('/data_types', 'DatatypeController@index');
    Route::get('/data_types_show', 'DatatypeController@show')->name('data_type_show');
    Route::post('/add_data_type', 'DatatypeController@create');
    Route::delete('/delete_data_types', 'DatatypeController@destroy');
    Route::get('/edit_data_type', 'DatatypeController@edit')->name('usertype.update');


    //Country #s
    Route::get('/viewAddCountry', function () {
        return view('website\backend.database pages.Add_Country');
    });
    Route::get('/show_country', 'CountryController@index')->name('country_show');
    Route::post('/add_country', 'CountryController@create');

    //State
    Route::get('/state', 'StateController@index');
    Route::post('/add_state', 'StateController@create');
    Route::get('/show_state', 'StateController@show')->name('state_show');

    //City
    Route::get('/city', 'CityController@index');
    Route::post('/add_city', 'CityController@create');
    Route::get('/show_city', 'CityController@show')->name('city_show');

    //Region
    Route::get('/region', 'RegionController@index');
    Route::post('/add_region', 'RegionController@create');
    Route::get('/show_region', 'RegionController@show')->name('region_show');

    //Street
    Route::get('/street', 'StreetController@index');
    Route::post('/add_street', 'StreetController@create');
    Route::get('/show_street', 'StreetController@show')->name('street_show');
    Route::delete('/delete_Street/{id?}', 'StreetController@destroy');
    Route::get('/edit_Street', 'StreetController@editStreet')->name('Street.edit');

    //Property Details pages #Tabbosha
    Route::get('/Property_Details', 'PropertyDetailsController@index');
    Route::get('/Property_Details_show', 'PropertyDetailsController@show')->name('property_detail_show');
    Route::post('/add_Property_Details', 'PropertyDetailsController@create');
    Route::get('/findPropertyDetail', 'PropertyDetailsController@find');
    Route::delete('/delete_property_detail', 'PropertyDetailsController@destroy');
    Route::get('/edit_property_detail', 'PropertyDetailsController@edit')->name('propertyDetail.update');


    //Property Details pages #Tabbosha
    Route::get('/property', 'SubTypePropertyController@index');
    Route::get('/sub_type_property_show', 'SubTypePropertyController@show')->name('subtypeproperty_show');
    Route::post('/add_sub_type_property', 'SubTypePropertyController@create');


    // Details pages #Tabboshak
    Route::get('/Details', 'DetailsController@index')->name('Details');
    Route::get('/Details_show', 'DetailsController@show')->name('details_show');
    Route::post('/add_Details', 'DetailsController@create')->name('details_submit');


    // Item  pages #Tabbosha
    Route::get('/Item', 'ItemController@index1');
    Route::post('/addItem', 'ItemController@create');
    Route::get('/ShowItem/{id?}', 'ItemController@show');
    Route::delete('/DelteItem/{id?}', 'ItemController@destroy');
    Route::get('/item_delete/{id?}', 'ItemController@destroy');
    Route::get('/edit_item_user/{id}', 'ItemController@ShowEditUser');
    Route::post('/edit_item_user2/{id}', 'ItemController@EditUser');
    Route::get('/edit_item_location/{id}', 'ItemController@ShowEditlocation');
    Route::Post('/edit_item_location2/{id}', 'ItemController@EditLocation');

    Route::get('/item_schedule/{id}', 'ScheduleController@index');
    Route::get('/show_item_schedule/{id}', 'ScheduleController@show')->name('show_item_schedule');
    Route::Post('/add_item_schedule/{id}', 'ScheduleController@create');
    Route::delete('/delete_schedule', 'ScheduleController@destroy');
    Route::get('/edit_schedule', 'ScheduleController@edit')->name('schedule.update');

    Route::get('/item_posts/{id}', 'PostsController@index');
    Route::Post('/add_item_post/{id?}', 'PostsController@create');
    Route::get('/delete_posts/{id?}', 'PostsController@destroy');

    Route::get('/item_gallery/{id}', 'AttachmentController@index');
    Route::Post('/add_item_gallery/{id}', 'AttachmentController@create');
    Route::get('/delete_gallery/{id?}', 'AttachmentController@destroy');
    Route::get('/edit_Comment', 'CustomerHomeController@editComment')->name('Comment.update');
    Route::get('/deletecomment/{id?}', 'CustomerHomeController@DestroyComment');
    Route::get('/deletePost/{id?}', 'CustomerHomeController@DestroyPost');
    Route::get('/edit_post', 'CustomerHomeController@editPost')->name('post.update');
    Route::get('/delete_reply/{id?}', 'CommentsController@destroyReply');

    Route::get('/delete_review/{id?}', 'ReviewController@destroy');
    Route::get('/item_reviews/{id}', 'ReviewController@index');


    //Route::get('/Item', 'ItemController@SubTypeShow');
    Route::get('/addItemSteps/{id}', 'ItemController@SubTypeShow');
    // Route::get('/Item_Main_types_show', 'ItemController@MainTypeShow');
    Route::get('/Item_Sub_types_show/{id}', 'ItemController@SubTypeShow');
    Route::get('/searchR', 'ItemController@searchEmail');
    //Sub type javacript phase
    Route::get('/findDetail', 'OperationsController@finddetail');
    Route::get('/findSub', 'SubTypes@find');
    Route::delete('/delete_sub_type/{id?}', 'SubTypes@destroy');
    Route::get('/edit_sub_type/{id}', 'SubTypes@getSubTypeById')->name('suptype.getbyid');
    Route::get('/edit_edit_sub_type', 'SubTypes@editSubType')->name('suptype.update');
    Route::post('/update_sub_type/{id}', 'SubTypes@update');
    Route::get('/findProperty', 'SubTypePropertyController@find');

    //Detail delete and edit
    Route::delete('/delete_sub_type_property/{id?}', 'SubTypePropertyController@destroy');
    Route::get('/edit_sub_type_property', 'SubTypePropertyController@edit')->name('subTypeProperty.update');

    //Search
    Route::delete('/delete_detail/{id?}', 'DetailsController@destroy');
    Route::delete('/delete_detail_item', 'DetailsController@destroydetail');
    Route::get('/edit_detail', 'DetailsController@edit')->name('Detail.update');
    Route::post('/add_Item_Detail/{property_id}', 'ItemController@submit');

    // Dynamic Drop Down For Country #s
    Route::get('/D1', 'StateController@findstate');
    Route::get('/D2', 'CityController@findstate');
    Route::get('/D3', 'CityController@findcity');
    Route::get('/D4', 'RegionController@findstate');
    Route::get('/D5', 'RegionController@findcity');
    Route::get('/D6', 'RegionController@findregion');
    Route::get('/D7', 'StreetController@findstreet');

    //Delete #s
    Route::delete('/delete_Country/{id?}', 'CountryController@destroy');
    Route::delete('/delete_State/{id?}', 'StateController@destroy');
    Route::delete('/delete_City/{id?}', 'CityController@destroy');
    Route::delete('/delete_Region/{id?}', 'RegionController@destroy');

    //Edit #s
    Route::get('/edit_Country', 'CountryController@editCountry')->name('Country.edit');
    Route::get('/edit_State', 'StateController@editState')->name('State.edit');
    Route::get('/edit_City', 'CityController@editCity')->name('City.edit');
    Route::get('/edit_Region', 'RegionController@editRegion')->name('Region.edit');

    //neww 7/12
    Route::get('/property_select/{item_id}/{sub_type_id}', 'SubTypePropertyController@property_select');
    Route::post('/submit_properties', 'PropertyDetailsController@submit_properties');

    // findDetailsForForm
    Route::get('/findDetailsForForm', 'PropertyDetailsController@findDetailsForForm')->name('propertyDetail.find');


    //User Pages #S
    Route::get('/User', 'AddUserController@Index');
    Route::Post('/Add_User', 'AddUserController@create');
    Route::get('/show_users', 'UserTypes@get_user_types');
    Route::get('/TypeOfUser', 'UserTypes@getUser')->name('users_show');
    Route::delete('/delete_user/{id?}', 'AddUserController@destroy');
    Route::get('/edit_User_Name', 'AddUserController@editUserName')->name('UserName.update');
    Route::get('/edit_User_Email', 'AddUserController@editUserEmail')->name('UserEmail.update');
    Route::get('/edit_User_PhoneNumber', 'AddUserController@editUserPhoneNumber')->name('UserPhoneNumber.update');

    Route::Post('/item_created', 'ItemController@itemShow');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', function () {
        return view('website\backend.layouts.Admin');
    });
    //search user

    Route::post('/search_user', 'AddUserController@search')->name('search');
    Route::get('/home', 'HomeController@index')->name('home');
// });

Route::get('/timeline',function () {
    return view('website.frontend.customer.TimeLine');
});

//Follow 
Route::get('/FollowItem/{id?}','AddUserController@FollowedItem');
Route::get('/UnfollowItem/{id?}','AddUserController@UnfollowItem');

Route::get('/HomePage', 'CustomerHomeController@HomePagePosts')->name('HomePage');
Route::post('/Reservation','HomeController@Reservation');

Route::get('/hamada/{id?}', 'CommentsController@getPostrepliesHomePage');
Route::get('/getRepliesFromComment', 'CommentsController@GetCommentReply')->name('get.replies');
Route::get('/getComment', 'CommentsController@GetComments')->name('get.comments');

Route::get('/EditCustomerProfile',function () {
    return view('website.frontend.customer.Customer_Own_Profile');
});
