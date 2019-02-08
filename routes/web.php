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

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get', 'post'], '/admin','AdminController@login');
Route::match(['get', 'post'], '/admin/recover','AdminController@recover');

//Route::match(['get','post'],'/register','UsersController@register');
//Route::match(['get','post'],'/login','UsersController@login');
//admin Route using manage middleware
Route::group(['middleware' => 'manage'], function(){
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/change_password', 'AdminController@change_password');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
	Route::match(['get','post'],'/admin/members/index','MemberController@index');
	Route::match(['get'],'/admin/members/add-member','MemberController@add_member');
	Route::match(['post'],'/admin/members/add-member','MemberController@store');
	Route::match(['get'],'/admin/members/edit-member/{id}','MemberController@edit_member');
	Route::match(['post'],'/admin/members/edit-member/{id}','MemberController@update');
	Route::get('/admin/members/delete-member-image/{id}','MemberController@deleteMemberImage');
	Route::get('/admin/members/view-member/{id}','MemberController@viewMembers');
	Route::get('/admin/members/delete-member/{id}','MemberController@deleteMember');
	Route::match(['get'],'/admin/members/change-password/{id}', 'MemberController@change_password');
	Route::match(['post'],'/admin/members/update-password/{id}','MemberController@updateMpassword');
	Route::match(['get'],'/admin/profile', 'AdminController@profile');
	Route::match(['post'],'/admin/update-profile/{id}','AdminController@updateProfile');
	Route::match(['get','post'],'/admin/members/view_genealogy/{id}','MemberController@viewGenealogy');
	Route::match(['get','post'],'/admin/members/view_genview/{id}','MemberController@viewGenview');
	//for emai templates
	Route::match(['get','post'],'/admin/emailtemplates','EmailtemplateController@index');
	Route::match(['get'],'/admin/emailtemplates/edit/{id}','EmailtemplateController@edit');
	Route::match(['post'],'/admin/emailtemplates/update/{id}','EmailtemplateController@update');
	//report
	Route::match(['get'],'/admin/reports/customer','ReportController@customer');
	//for cms pages
	Route::match(['get','post'],'/admin/cmspages','CmspageController@index');
	Route::match(['get'],'/admin/cmspages/add-cmspage','CmspageController@add_cmspage');
	Route::match(['post'],'/admin/cmspages/add-cmspage','CmspageController@store');
	Route::match(['get'],'/admin/cmspages/edit/{id}','CmspageController@edit');
	Route::match(['post'],'/admin/cmspages/update/{id}','CmspageController@update');
	//for sms templates
	Route::match(['get','post'],'/admin/smstemplates','SmstemplateController@index');
	Route::match(['get'],'/admin/smstemplates/add','SmstemplateController@add');
	Route::match(['post'],'/admin/smstemplates/add','SmstemplateController@store');
	Route::match(['get'],'/admin/smstemplates/edit/{id}','SmstemplateController@edit');
	Route::match(['post'],'/admin/smstemplates/update/{id}','SmstemplateController@update');
	Route::get('/admin/smstemplates/delete/{id}','SmstemplateController@delete');
	//for news letter send
	Route::match(['get','post'],'/admin/newsletters','NewsletterController@index');
	Route::match(['post'],'/admin/newsletters/send','NewsletterController@send');
	//for Cms Faq
	Route::match(['get','post'],'/admin/faqs','FaqController@index');
	Route::match(['get'],'/admin/faqs/add','FaqController@add');
	Route::match(['post'],'/admin/faqs/add','FaqController@store');
	Route::match(['get'],'/admin/faqs/edit/{id}','FaqController@edit');
	Route::match(['post'],'/admin/faqs/update/{id}','FaqController@update');
	Route::get('/admin/faqs/delete/{id}','FaqController@delete');
	//for Banners
	Route::match(['get','post'],'/admin/banners','BannerController@index');
	Route::match(['get'],'/admin/banners/add','BannerController@add');
	Route::match(['post'],'/admin/banners/add','BannerController@store');
	Route::match(['get'],'/admin/banners/edit/{id}','BannerController@edit');
	Route::match(['post'],'/admin/banners/update/{id}','BannerController@update');
	Route::get('/admin/banners/delete/{id}','BannerController@delete');
	//settings admin
	Route::match(['get'],'/admin/generalsetting', 'SettingController@index');
	Route::match(['post'],'/admin/site-update/{id}','SettingController@updateSite');
	Route::get('/admin/settings/delete-logo-image/{id}','SettingController@deleteSettingLogo');
	
});

Route::get('/logout', 'AdminController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
