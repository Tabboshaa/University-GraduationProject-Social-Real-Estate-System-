<?php
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

Route::get('/', 'DatatypeController@index');
//main types pages
Route::get('/main_types', 'MainTypes@index');
Route::get('/main_types_show', 'MainTypes@show')->name('main_types_show');
Route::post('/add_main_type','MainTypes@create');
Route::delete('/delete_main_type','MainTypes@destroy');
Route::get('/edit_main_type','MainTypes@edit')->name('Maintype.update');

//sub types pages
Route::get('/sub_types', 'SubTypes@index');
Route::get('/sub_types_show', 'SubTypes@show')->name('subtype_show');
Route::post('/add_sub_type','SubTypes@create');
Route::delete('/delete_sub_type','SubTypes@destroy');

//User types pages
Route::get('/user_types', 'UserTypes@index');
Route::post('/add_user_type','UserTypes@create');
Route::get('/user_types_show', 'UserTypes@show')->name('usertype_show');
Route::delete('/delete_user_type/{id?}','UserTypes@destroy');
Route::get('/edit_user_type','UserTypes@edit')->name('usertype.edite');

//Data types pages
Route::get('/data_types', 'DatatypeController@index');
Route::get('/data_types_show', 'DatatypeController@show')->name('data_type_show');
Route::post('/add_data_type','DatatypeController@create');
Route::delete('/delete_data_types','DatatypeController@destroy');
Route::get('/edit_data_type','DatatypeController@edit')->name('usertype.update');


//Country #s
Route::get('/viewAddCountry', function () {
    return view('website\backend.database pages.Add_Country');
});
Route::get('/show_country','CountryController@index')->name('country_show');
Route::post('/add_country','CountryController@create');

//State
Route::get('/state','StateController@index');
Route::post('/add_state','StateController@create');
Route::get('/show_state','StateController@show')->name('state_show');

//City
Route::get('/city','CityController@index');
Route::post('/add_city','CityController@create');
Route::get('/show_city','CityController@show')->name('city_show');

//Region
Route::get('/region','RegionController@index');
Route::post('/add_region','RegionController@create');
Route::get('/show_region','RegionController@show')->name('region_show');

//Street
Route::get('/street','StreetController@index');
Route::post('/add_street','StreetController@create');
Route::get('/show_street','StreetController@show')->name('street_show');
Route::delete('/delete_Street/{id?}','StreetController@destroy');
Route::get('/edit_Street','StreetController@editStreet')->name('Street.edit');

//Property Details pages #Tabbosha
Route::get('/Property_Details', 'PropertyDetailsController@index');
Route::get('/Property_Details_show', 'PropertyDetailsController@show')->name('property_detail_show');
Route::post('/add_Property_Details','PropertyDetailsController@create');
Route::get('/findPropertyDetail','PropertyDetailsController@find');
Route::delete('/delete_property_detail','PropertyDetailsController@destroy');
Route::get('/edit_property_detail','PropertyDetailsController@edit')->name('propertyDetail.update');

//Property Details pages #Tabbosha
Route::get('/property', 'SubTypePropertyController@index');
Route::get('/sub_type_property_show', 'SubTypePropertyController@show')->name('subtypeproperty_show');
Route::post('/add_sub_type_property','SubTypePropertyController@create');


// Details pages #Tabbosha
Route::get('/Details', 'DetailsController@index');
Route::get('/Details_show', 'DetailsController@show')->name('details_show');
Route::post('/add_Details','DetailsController@create')->name('details_submit');



Route::get('/User','AddUserController@Index');
Route::Post('/Add_User','AddUserController@Create');


// Item  pages #Tabbosha
Route::get('/Item', 'ItemController@SubTypeShow');
// Route::get('/Item_Main_types_show', 'ItemController@MainTypeShow');
Route::get('/Item_Sub_types_show', 'ItemController@SubTypeShow');
//Sub type javacript phase
Route::get('/findSub','SubTypes@find');
Route::delete('/delete_sub_type/{id?}','SubTypes@destroy');
Route::get('/edit_sub_type/{id}','SubTypes@getSubTypeById')->name('suptype.getbyid');
Route::get('/edit_edit_sub_type','SubTypes@editSubType')->name('suptype.update');
Route::post('/update_sub_type/{id}','SubTypes@update');
Route::get('/findProperty','SubTypePropertyController@find');

//Detail delete and edit
Route::delete('/delete_sub_type_property/{id?}','SubTypePropertyController@destroy');
Route::get('/edit_sub_type_property','SubTypePropertyController@edit')->name('subTypeProperty.update');


Route::delete('/delete_detail/{id?}','DetailsController@destroy');
Route::get('/edit_detail','DetailsController@edit')->name('Detail.update');



Route::post('/add_Item_Detail/{property_id}','ItemController@submit');

// Dynamic Drop Down For Country #s
Route::get('/D1','StateController@findstate');
Route::get('/D2','CityController@findstate');
Route::get('/D3','CityController@findcity');
Route::get('/D4','RegionController@findstate');
Route::get('/D5','RegionController@findcity');
Route::get('/D6','RegionController@findregion');

//Delete #s
Route::delete('/delete_Country/{id?}','CountryController@destroy');
Route::delete('/delete_State/{id?}','StateController@destroy');
Route::delete('/delete_City/{id?}','CityController@destroy');
Route::delete('/delete_Region/{id?}','RegionController@destroy');

//Edit #s
Route::get('/edit_Country','CountryController@editCountry')->name('Country.edit');
Route::get('/edit_State','StateController@editState')->name('State.edit');
Route::get('/edit_City','CityController@editCity')->name('City.edit');
Route::get('/edit_Region','RegionController@editRegion')->name('Region.edit');

//neww 7/12
Route::get('/property_select/{sub_type_id}','SubTypePropertyController@property_select');
Route::post('/submit_properties','PropertyDetailsController@submit_properties');

// findDetailsForForm
Route::get('/findDetailsForForm','PropertyDetailsController@findDetailsForForm')->name('propertyDetail.find');


//User Pages #S
Route::get('/User','AddUserController@Index');
Route::Post('/Add_User','AddUserController@Create');
Route::get('/show_users' , 'UserTypes@get_user_types');
Route::get('/TypeOfUser/{id}','UserTypes@getUser')->name('users_show');
Route::delete('/delete_user/{id?}','AddUserController@destroy');
Route::get('/edit_User_Name','AddUserController@editUserName')->name('UserName.update');
Route::get('/edit_User_Email','AddUserController@editUserEmail')->name('UserEmail.update');
Route::get('/edit_User_PhoneNumber','AddUserController@editUserPhoneNumber')->name('UserPhoneNumber.update');







