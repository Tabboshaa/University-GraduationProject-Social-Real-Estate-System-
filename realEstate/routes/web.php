<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use App\Schedule;
use Carbon\Carbon;
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
Route::get('/Land', function () {
    return view('website\LandingPadge');
});
//authntication routes
Route::get('/meshtest/{item_id}','ScheduleController@getAvailableTime');
Auth::routes();
Route::post('/loginAdmin', 'Auth\LoginController@loginViaEmailAdmin')->name('loginAdmin');
Route::post('/login', 'Auth\LoginControllerUser@loginViaEmail')->name('loginUser');
Route::POST('/registerUser', 'Auth\RegisterController@create')->name('registerUser');
Route::get('/UserRegister', function () {
    return view('website\frontend\Registration');
})->name('UserRegister');

Route::get('/UserLogin', function () {
    return view('website\frontend\login');
})->name('userLogin');

Route::get('/AdminLogin', function () {
    return view('auth\login');
})->name('AdminLogin');

Route::get('/s', function () {
    return view('website\frontend\customer\calender');
});

//Customer Routes with middleware
Route::group(['middleware' => 'auth.user'], function () {
    Route::get('/', 'CustomerHomeController@index')->name('CustomerHome');
    //Customer HOMEpage
    Route::get('/HomeRegister', 'CustomerHomeController@index')->name('HomeRegister');
    Route::get('/search_by_place', 'CustomerHomeController@findItemInState');
    Route::get('/search_by_placedate', 'CustomerHomeController@findItemInStateAndDate');

    //Customer Comment
    Route::get('/add_comment', 'CommentsController@create')->name('comment.add');
    Route::get('/add_reply', 'CommentsController@reply')->name('reply.add');
    Route::get('/addReview', 'ReviewController@create')->name('review.add');


    //operations
    Route::get('/Payment', 'OperationsController@calculateDays')->name('calculate.days');
    Route::get('/operation_func', 'OperationsController@create');
    Route::get('/reservations/{item_id?}', 'OperationsController@showreservations');
    Route::get('/user_reservations', 'OperationsController@showuserreservations')->name('user_reservations');
    Route::get('/operation_delete/{id?}', 'OperationsController@destroyOperation');
    //Payment
    Route::get('/creditCard', function () {

        return view('website.frontend.customer.Reservation');
    });
    Route::post('reserve', 'PaymentController@create');
    Route::get('/reserve', function () {
        return view('website\backend.database pages.add-Reservation');
    });
    Route::get('/Payment/{item_id}/{schedule}/{numberOfDays}/{totalCost}/{price_per_night}/{start_date}/{end_date}', 'PaymentController@show_payment');

    //items Profile Pages
    Route::get('/itemProfile/{id?}', 'CustomerHomeController@itemProfile');
    Route::get('/itemDetails/{id?}', 'CustomerHomeController@itemDetails');
    Route::get('/itemGallery/{id?}', 'CustomerHomeController@itemProfileGallery');
    Route::get('/itemReviews/{id?}', 'CustomerHomeController@itemProfileReviews');

    //notification soft delete
    Route::get('/view_notification', 'NotificationController@viewNotification')->name('view_notification');


    Route::get('/timeline', function () {
        return view('website.frontend.customer.TimeLine');
    });

    //Cover and Profile Photo customer profile
    Route::post('/CreateCoverPhoto', 'CoverPhotoController@create')->name('create.coverphoto');
    Route::delete('/DeleteMyCoverPhoto/{id?}/{File_Path?}', 'CoverPhotoController@destroy');
    Route::delete('/DeleteMyProfilePhoto/{id?}/{File_Path?}', 'ProfilePhotoController@destroy');
    Route::post('/CreateProfilePhoto', 'ProfilePhotoController@create')->name('create.profilephoto');
    Route::post('/UpdateCoverPhoto', 'CoverPhotoController@edit')->name('create.coverphoto');
    Route::POST('/UpdateProfilePhoto', 'ProfilePhotoController@edit')->name('create.profilephoto');

    //owner item coverpage edit
    Route::post('/UpdateCoverPage/{id?}', 'CoverPageController@edit');
    Route::delete('/DeleteMyCoverPage/{id?}/{path?}', 'CoverPageController@destroy');
    Route::post('/CreateCoverPage/{id?}', 'CoverPageController@create');
    //Follow
    //Follow
    Route::get('/FollowItem/{id?}', 'UserController@FollowedItem');
    Route::get('/UnfollowItem/{id?}', 'UserController@UnfollowItem');

    Route::get('/FollowUser/{id?}', 'FollowedusersController@FollowedUser');
    Route::get('/UnfollowUser/{id?}', 'FollowedusersController@UnfollowUser');

    Route::get('/HomePage', 'CustomerHomeController@HomePagePosts')->name('HomePage');
    Route::get('/HomepageUserPosts', 'CustomerHomeController@HomePageUserPosts')->name('HomePageuser');
    Route::post('/Reservation', 'HomeController@Reservation');

    Route::get('/hamada/{id?}', 'CommentsController@getPostrepliesHomePage');
    Route::get('/getRepliesFromComment', 'CommentsController@GetCommentReply')->name('get.replies');
    Route::get('/getComment', 'CommentsController@GetComments')->name('get.comments');

    Route::get('/EditCustomerProfile', 'UserController@showMyProfile');
    Route::get('/ReservationShow', 'ReservationController@show');
    Route::get('/StatesPhotos', 'StatePhotoController@index');
    Route::POST('/add_StatePhoto', 'StatePhotoController@create');
    Route::get('/shaimaa', 'CustomerHomeController@indexPhoto');
    Route::get('/myReservations', 'ReservationController@show');

            Route::Post('/BeOwner/{id?}', 'UserController@BeOwner')->name('BeOwner');
    Route::get('/BeOwner/{id?}', 'UserController@BeOwner');

    Route::get('/checkIfOwner', 'UserController@checkIfOwner')->name('checkIfOwner');

    //Owner
    Route::post('/OwnerAddItem', 'ItemController@OwnerAddItem');

    Route::get('/owneritemProfile/{id?}', 'ItemProfileController@itemProfile');
    Route::get('/owneritemDetails/{id?}', 'ItemProfileController@itemDetails');
    Route::get('/owneritemGallery/{id?}', 'ItemProfileController@itemProfileGallery');
    Route::get('/deleteImgFromGallery', 'PostAttachmentController@deleteImgFromGallery')->name('deleteImgFromGallery');
    Route::get('/createAttachment', 'AttachmentControllera@createAttachment');
    Route::get('/owneritemReviews/{id?}', 'ItemProfileController@itemProfileReviews');
    Route::get('/owneritemReservations/{id?}', 'ItemProfileController@itemReservations');
    Route::get('/owneritemManageSchedule/{id?}', 'ItemProfileController@itemManageSchedule');
    Route::get('/owneradditemschedule', 'ScheduleController@Ownercreate')->name('Add_Schedule');

    Route::get('/MyItems', 'OwnerController@index');
    Route::get('/MyReservations', 'OwnerController@getReservations');//not done

    Route::get('/Amr/{id?}', 'ItemController@SelectSubType');
    Route::get('/OwnerSelectSubType/{id?}', 'ItemController@SelectSubType');
    Route::get('/OwnerSelectDetails/{item_id}/{sub_type_id}', 'ItemController@OwnerSelectProperty');
    Route::get('/OwnerAddItem', function () {
        return view('website\frontend.Owner.Add_Item');
    });
    Route::get('/test', 'NotificationController@index');
});



//Admin Routes with middleware
Route::group(['middleware' => 'Admin'], function () {
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
    Route::get('/operation_types_show', 'OperationsController@show')->name('operation_types_show');
    Route::get('/operation_details_show', 'OperationsController@showDetail')->name('operation_types_show');
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
    Route::get('/state', 'StateController@index')->middleware('Admin');
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
    Route::post('/Edit_Details', 'DetailsController@editDetails')->name('details.edit');
    Route::POST('/addImageForAProperty/{item_id?}/{property_id?}/{diff?}', 'DetailsController@AddImage');


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
    Route::post('/add_item_schedule/{id?}', 'ScheduleController@create');
    Route::delete('/delete_schedule', 'ScheduleController@destroy');
    Route::get('/edit_schedule', 'ScheduleController@edit')->name('schedule.update');

    Route::get('/item_posts/{id}', 'PostsController@index');
    Route::Post('/add_item_post/{id?}', 'PostsController@create');
    Route::Post('/add_user_post', 'PostsController@create');
    Route::get('/delete_posts/{id?}', 'PostsController@destroy');

    Route::get('/item_gallery/{id}', 'AttachmentController@index');
    Route::POST('/add_item_gallery/{id}', 'AttachmentController@create');
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
    Route::get('/D2', 'StateController@findstate');
    Route::get('/D3', 'CityController@findcity');
    Route::get('/D4', 'StateController@findstate');
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
    Route::get('/findDetails', 'PropertyDetailsController@findDetailsForForminOwner')->name('Details.find');
    Route::get('/findDetailsForShow', 'DetailsController@findDetailsForShow')->name('detail.find'); //to be deleted!!
    Route::get('/DeleteDetailsOwner', 'DetailsController@destroydetails')->name('delete.details');
    Route::get('/DeleteDetailImageOwner', 'DetailsController@destroydetail')->name('delete.detail');


    //User Pages #S
    Route::get('/User', 'UserController@Index');
    Route::Post('/Add_User', 'UserController@create');
    Route::get('/show_users', 'UserTypes@get_user_types');
    Route::get('/TypeOfUser', 'UserTypes@getUser')->name('users_show');
    Route::delete('/delete_user/{id?}', 'UserController@destroy');
    Route::get('/edit_User_Name', 'UserController@editUserName')->name('UserName.update');
    Route::get('/edit_User_Email', 'UserController@editUserEmail')->name('UserEmail.update');
    Route::get('/edit_User_PhoneNumber', 'UserController@editUserPhoneNumber')->name('UserPhoneNumber.update');
    Route::get('/view_User/{id}', 'UserController@show');

    Route::Post('/item_created', 'ItemController@itemShow');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', function () {
        return view('website\backend.layouts.Admin');
    });
    //search user

    Route::post('/search_user', 'UserController@search')->name('search');
    Route::get('/operationtypes', function () {
        return view('website\backend.database pages.operationTypes');
    });

    Route::get('/state1', function () {
        return view('website\backend.database pages.StatePhoto');
    });
});
//paypal

Route::POST('paypalCall/{item_id?}/{schedule?}/{numberOfDays?}/{totalCost?}/{price_per_night?}/{start_date?}/{end_date?}','PaypalController@index')->name('paypalCall');
Route::get('paypalReturn/{itemId}/{schedule}/{numberOfDays}/{totalCost}/{pricePerNight}/{startDate}/{endDate}','PaypalController@paypalReturn')->name('paypalReturn');

Route::get('sendMailAfterReservation','PaypalController@sendDoneMail');
Route::get('terms',function() {
    return view('terms');
});
Route::get('policy',function() {
    return view('Policy');
});

Route::get('redirect/{service}','SocialController@redirect');
Route::get('callback/{service}','SocialController@callback');

Route::get('map',function (){
    return view('map');
});

Route::get('EditUserProfile','UserController@EditUserProfileVeiw');
Route::POST('/EditUserProfile1','UserController@EditUserProfile');
Route::POST("/EditItemMap/{id?}",'ItemController@EditItemMap');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::POST('/ForgotPassword','Auth\ForgotPasswordController@forgotPassword');
//Route::get('/ForgotPassword' ,function () {
//    return view('website\frontend\login');
//});
Route::get('changePassword','UserController@changePassword')->name('changePassword');
Route::POST('activateRegister','Auth\RegisterController@activateRegister')->name('activateRegister');
Route::get('AdminProfile','AddUserController@AdminProfile');
