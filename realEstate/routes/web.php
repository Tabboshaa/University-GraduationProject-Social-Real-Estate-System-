<?php

use App\Main_Type;
use App\Sub_Type;
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

Route::get('/', 'SubTypes@index');
//main types pages
Route::get('/main_types', 'MainTypes@index');
Route::get('/main_types_show', 'MainTypes@show')->name('main_types_show');
Route::post('/add_main_type','MainTypes@create');
//sub types pages
Route::get('/sub_types', 'SubTypes@index');
Route::get('/sub_types_show', 'SubTypes@show');
Route::post('/add_sub_type','SubTypes@create');
Route::get('/delete/{id}','SubTypes@destroy');
//User types pages
Route::get('/user_types', 'UserTypes@index');
Route::get('/user_types_show', 'UserTypes@show');
Route::post('/add_user_type','UserTypes@create');

//Country #s
Route::get('/viewAddCountry', function () {
    return view('website\backend.database pages.Add_Country');
});
Route::get('/show_country','CountryController@index');

//State
Route::get('/state','StateController@index');
Route::post('/add_state','StateController@create');
Route::get('/show_state','StateController@show');

//City
Route::get('/city','CityController@index');
Route::post('/add_city','CityController@create');
Route::get('/show_city','CityController@show');

//Region
Route::get('/region','RegionController@index');
Route::post('/add_region','RegionController@create');
Route::get('/show_region','RegionController@show');

//Street
Route::get('/street','StreetController@index');
Route::post('/add_street','StreetController@create');
Route::get('/show_street','StreetController@show');

//Property Details pages #Tabbosha
Route::get('/Property_Details', 'PropertyDetailsController@index');
Route::get('/Property_Details_show', 'PropertyDetailsController@show');
Route::post('/add_Property_Details','PropertyDetailsController@create');

//Property Details pages #Tabbosha
Route::get('/property', 'SubTypePropertyController@index');
Route::get('/sub_type_property_show', 'SubTypePropertyController@show');
Route::post('/add_sub_type_property','SubTypePropertyController@create');

// Details pages #Tabbosha
Route::get('/Details', 'DetailsController@index');
Route::get('/Details_show', 'DetailsController@show');
Route::post('/add_Details','DetailsController@create');

// add user
Route::get('/User','AddUserController@Index');
Route::Post('/Add_User','AddUserController@Create');


// Item  pages #Tabbosha
Route::get('/Item', 'ItemController@index');
Route::get('/Item_Main_types_show', 'ItemController@MainTypeShow');
Route::get('/Item_Sub_types_show/{id}', 'ItemController@SubTypeShow');
Route::get('/Item_Details_show/{main_id}/{id}', 'ItemController@DetailShow');

//Sub type javacript phase
Route::get('/findSub','SubTypes@find');
Route::delete('/delete_sub_type/{id?}','SubTypes@destroy');
Route::get('/edit_sub_type/{id}','SubTypes@getSubTypeById')->name('suptype.getbyid');
Route::get('/edit_edit_sub_type','SubTypes@editSubType')->name('suptype.update');
Route::get('/update_get_sub_type/{id}', function ($id){

    $sub_types=Sub_Type::all();
    $subtypeid=$id;
    $main_types=Main_Type::all();
    return view('website.backend.database pages.Edit_Sup_Type',['sub_type'=>$sub_types,'main_type'=>$main_types,'supTypeId'=>$subtypeid]);
});
Route::post('/update_sub_type/{id}','SubTypes@update');
Route::get('/findProperty','SubTypePropertyController@find');
Route::get('/findPropertyDetail','PropertyDetailsController@find');

//Detail delete and edit
Route::delete('/delete_sub_type_property/{id?}','SubTypePropertyController@destroy');
Route::get('/edit_sub_type_property','SubTypePropertyController@edit')->name('subTypeProperty.update');

Route::delete('/delete_property_detail/{id?}','PropertyDetailsController@destroy');
Route::get('/edit_property_detail','PropertyDetailsController@edit')->name('propertyDetail.update');


Route::delete('/delete_detail/{id?}','DetailsController@destroy');
Route::get('/edit_detail','DetailsController@edit')->name('Detail.update');

Route::delete('/delete_main_type','MainTypes@destroy');
Route::get('/edit_main_type','MainTypes@edit')->name('Maintype.update');

Route::delete('/delete_user_type/{id?}','UserTypes@destroy');
Route::get('/edit_user_type','UserTypes@edit')->name('usertype.update');

Route::post('/add_Item_Detail/{main_id}/{sub_id}/{property_id}','ItemController@submit');

// Dynamic Drop Down For Country #s
Route::get('/D1','StateController@findstate');
Route::get('/D2','CityController@findstate');
Route::get('/D3','CityController@findcity');
Route::get('/D4','RegionController@findstate');
Route::get('/D5','RegionController@findcity');
Route::get('/D6','RegionController@findregion');

//Delete #s
Route::Post('/delete_Country/{id?}','CountryController@destroy');
Route::Post('/delete_State/{id?}','StateController@destroy');
Route::Post('/delete_City/{id?}','CityController@destroy');
Route::Post('/delete_Region/{id?}','RegionController@destroy');
Route::Post('/delete_Street/{id?}','StreetController@destroy');

//Edit #s
Route::get('/edit_Country','CountryController@editCountry')->name('Country.edit');
Route::get('/edit_State','StateController@editState')->name('State.edit');
Route::get('/edit_City','CityController@editCity')->name('City.edit');
Route::get('/edit_Region','RegionController@editRegion')->name('Region.edit');
Route::get('/edit_Street','StreetController@editStreet')->name('Street.edit');
