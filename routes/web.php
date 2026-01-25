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
Route::get('/', 'FrontendControllers\FrontpageController@index')->name('index');

/* Authentication Routes... */
Route::get('adminisclient', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('adminisclient', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::redirect('/dashboard', '/admin/dashboard', 301);
//================== Frontend Routes =================//
Route::get('banners', 'FrontendControllers\FrontpageController@banners');

// Normal Pages
Route::get('{uri}.html', 'FrontendControllers\FrontpageController@pagedetail')->name('page.pagedetail');
Route::get('page/{uri}.html', 'FrontendControllers\FrontpageController@posttype')->name('page.posttype');
Route::get('service-category/{uri}.html', 'FrontendControllers\FrontpageController@servicetype')->name('page.servicetype');
Route::get('trades/detail/{uri}', 'FrontendControllers\FrontpageController@portfolio')->name('page.portfolio');

Route::get('{parenturi}/{uri}.html', 'FrontendControllers\FrontpageController@pagedetail_child')->name('page.pagedetail_child');
Route::get('page/photogallery/{category_id}', 'FrontendControllers\FrontpageController@photo_gallery');

// Send Mail
Route::post('page/contact/sendmail', 'FrontendControllers\FrontpageController@sendmail')->name('sendmail');
Route::post('/contact-mail', 'FrontendControllers\FrontpageController@sendmail_contact')->name('sendmail-contact');
Route::get('category/{uri}', 'FrontendControllers\FrontpageController@category_navigation')->name('category.navigation');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Esewa Routes
Route::any('/payment/verify',[App\Http\Controllers\EsewaController::class,'payment_verify'])->name('payment.verify');
Route::any('/esewa/sucess',[App\Http\Controllers\EsewaController::class,'success'])->name('esewa.sucess');
Route::any('/esewa/failure',[App\Http\Controllers\EsewaController::class,'failure'])->name('esewa.failure');
Route::get('/esewa/response/{id?}', [App\Http\Controllers\EsewaController::class, 'response'])->name('payment.response');

// Khalti Routes
Route::any('/payment/khalti', [App\Http\Controllers\KhaltiController::class, 'paymentKhalti'])->name('payment.khalti');
Route::get('/khalti-redirect', [App\Http\Controllers\KhaltiController::class, 'khaltiRedirect']);
Route::get('khalti/message/{id?}', [App\Http\Controllers\KhaltiController::class, 'khaltiPaymentResponseMessage'])->name('khalti.message');

Route::get('register-now', 'FrontendControllers\FrontpageController@become_member')->name('register-now');
Route::post('become-member', 'FrontendControllers\FrontpageController@become_member')->name('become-member');
Route::any('application-view', 'FrontendControllers\FrontpageController@application_view')->name('application-view');

Route::get('register-now/{uri}', 'FrontendControllers\FrontpageController@register_now');

//latest futsal addition
Route::get('futsal-registrations', 'FrontendControllers\FrontpageController@futsal_registration')->name('futsal-registration');
Route::post('futsal-registration', 'FrontendControllers\FrontpageController@futsal_registration')->name('futsal-registration');
Route::get('futsal-payment', 'FrontendControllers\FrontpageController@futsal_payment')->name('futsal-payment');
Route::any('futsal-payment-verify',[App\Http\Controllers\EsewaController::class,'futsal_payment'])->name('futsal.payment');
Route::any('/futsal-payment/success',[App\Http\Controllers\EsewaController::class,'payment_success'])->name('payment.sucess');
Route::any('/futsal-payment/failure',[App\Http\Controllers\EsewaController::class,'payment_failure'])->name('payment.failure');
Route::get('/futsal-payment/response/{id?}', [App\Http\Controllers\EsewaController::class, 'payment_response'])->name('esewa.response');


//=========================================== Backend Routes =======================================================//
Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', 'DashboardController@index')->name('dashboard');

    // newsletter routes
    Route::get('send-newsletter', 'SendMailController@index')->name('send.newsletter');
    Route::any('users-send-email', 'SendMailController@sendEmail')->name('ajax.send.email');
    Route::get('newsletter-create', 'SendMailController@newsletter')->name('newsletter.create');
    Route::post('newsletters', 'SendMailController@newsletter')->name('newsletter.submit');
    Route::get('newsletter-index', 'SendMailController@newsindex')->name('newsletter.index');
    Route::get('newsletter-edit/{id?}', 'SendMailController@newsedit')->name('newsletter.edit');
    Route::post('newsletter-edit/{id?}', 'SendMailController@newsedit')->name('newsletter.edit');
    Route::get('newsletter-delete/{id?}', 'SendMailController@newsdelete')->name('newsletter.delete');
    Route::get('subscriber-create', 'SendMailController@usercreate')->name('subscriber.create');
    Route::post('subscriber-create', 'SendMailController@usercreate')->name('subscriber.submit');
    Route::get('subscriber-index', 'SendMailController@userindex')->name('subscriber.index');
    Route::get('subscriber-edit/{id?}', 'SendMailController@useredit')->name('subscriber.update');
    Route::post('subscriber-edit/{id?}', 'SendMailController@useredit')->name('subscriber.edit');
    Route::get('subscriber-delete/{id?}', 'SendMailController@userdelete')->name('user.delete');
    Route::get('assign-reg-no/{id?}', 'SendMailController@assignregno')->name('assign-reg-no');

    // Runner Registration
    Route::get('admin/register-now/{id}', 'DashboardController@admin_become_member');
    Route::post('admin/register-now', 'DashboardController@admin_become_member')->name('admin-become-member');
    Route::get('admin/runners', 'DashboardController@member_list')->name('members-list');
    Route::get('admin/runner/{id?}', 'DashboardController@deletemember')->name('deletemember');
    Route::get('admin/donation-details/{id?}', 'DashboardController@donation_details')->name('donation-details');
    Route::get('admin/runner-details/{id?}', 'DashboardController@member_details')->name('member-details');
    Route::any('admin/runner-details/{id?}/edit', 'DashboardController@edit_member_details')->name('edit-member-details');
    Route::post('payment-verified/{id?}', 'DashboardController@isverified')->name('payment-verified');
    Route::delete('payment-delete/{id}','DashboardController@deletePayment')->name('delete-payment');
    Route::post('payment-status/{id?}', 'DashboardController@payment_status')->name('payment-status');    
    Route::post('admin/marathon_filter', 'DashboardController@marathon_filter')->name('marathon_filter');

    Route::get('admin/admin-user', 'AdminControllers\Members\UserController@admin_user');
    Route::get('admin/agent-user', 'AdminControllers\Members\UserController@agent_user');
    Route::resources([
    'admin/adminmenu' => 'AdminControllers\AdminMenu\AdminMenuController',
    'admin/user' => 'AdminControllers\Members\UserController',
    'admin/banner' => 'AdminControllers\Banners\BannerController',
    'admin/postcategory' => 'AdminControllers\Posts\PostCategoryController',
    'admin/imagecategory' => 'AdminControllers\Galleries\ImageGalleryCategoryController',
    'admin/imagegallery' => 'AdminControllers\Galleries\ImageGalleryController',
    'admin/videocategory' => 'AdminControllers\Galleries\VideoGalleryCategoryController',
    'admin/videogallery' => 'AdminControllers\Galleries\VideoGalleryController',
    'admin/settings' => 'AdminControllers\Settings\SettingController',
    'admin/portfoliocategory' => 'AdminControllers\Portfolios\PortfolioCategoryController',
    'admin/our-trades' => 'AdminControllers\Portfolios\PortfolioController',
    'admin/member' => 'AdminControllers\Members\MemberController',
    'admin/role' => 'AdminControllers\Members\RoleController',
    'admin/event' => 'AdminControllers\Event\EventController',
    'admin/event-category' => 'AdminControllers\Event\EventCategoryController',
     'admin/futsal-event' => 'AdminControllers\Event\FutsalEventController',
    'admin/futsal-team' => 'AdminControllers\Event\FutsalTeamController',
    'admin/futsal-player' => 'AdminControllers\Event\FutsalPlayerController', 
    ]);
    Route::post('futsal-isdefault/{id?}', 'AdminControllers\Event\FutsalEventController@isdefault')->name('futsal.isdefault');
    Route::delete('admin/futsal-teams/{id}/{info_id}','AdminControllers\Event\FutsalTeamController@team_destroy')->name('team.destroy');


     Route::post('event-isdefault/{id?}', 'AdminControllers\Event\EventController@isdefault')->name('event.isdefault');

     Route::get('admin/futsal-event/{id}/destroy', 'AdminControllers\Event\FutsalEventController@destroy');
    Route::get('admin/futsal-team/{id}/destroy', 'AdminControllers\Event\FutsalTeamController@destroy');
     Route::get('admin/event/{id}/destroy', 'AdminControllers\Event\EventController@destroy');
     Route::get('admin/event-category/{id}/destroy', 'AdminControllers\Event\EventCategoryController@destroy');

    // Upload multiple image
    Route::get('adminimg/multiplephoto/{post_id}', 'AdminControllers\Posts\PostImageController@upload_form')->name('admin.multiplephoto');
    Route::post('multiplephoto/store', 'AdminControllers\Posts\PostImageController@store')->name('multiplephoto.store');
    Route::get('adminimg/multiplephoto/{post_id}/{id}/edit', 'AdminControllers\Posts\PostImageController@edit')->name('edit.multiplephoto');
     Route::put('adminimg/multiplephoto/{id}', 'AdminControllers\Posts\PostImageController@update')->name('multiplephoto.update');
    Route::delete('adminimg/multiplephoto/{id}', 'AdminControllers\Posts\PostImageController@destroy');

    Route::resource('admin.multiplevideo', 'AdminControllers\Posts\MultipleVideoController');
    Route::resource('admin.multiplebanner', 'AdminControllers\MultipleBanners\MultipleBannerController');

    Route::get('admin/permissionedit/{user}', 'AdminControllers\Members\UserController@permission_edit')->name('user.permissionEdit');;
    Route::put('admin/permissionedit/{user}', 'AdminControllers\Members\UserController@permission_update')->name('user.permissionUpdate');;

    Route::get('admin/assignroles/{id}', 'AdminControllers\Members\UserController@assign_roles')->name('user.assignroles');
    Route::put('admin/assignroles/{user}', 'AdminControllers\Members\UserController@update_roles')->name('user.update_roles');

    Route::get('admin/userprofile', 'AdminControllers\Members\UserController@userprofile')->name('admin.userprofile');
    Route::put('admin/update_password', 'AdminControllers\Members\UserController@update_password')->name('admin.update_password');
    Route::get('admin/changepassword', 'AdminControllers\Members\UserController@changepassword')->name('admin.changepassword');

    // For posttype
    Route::get('type/{posttype}', 'AdminControllers\Posts\PostTypeController@index')->name('type.posttype.index');
    Route::get('type-user/{posttype}', 'AdminControllers\Posts\PostTypeController@index_user')->name('type.posttype.index.user');
    Route::get('type/{posttype}/create', 'AdminControllers\Posts\PostTypeController@create')->name('type.posttype.create');
    Route::post('type/{posttype}/store', 'AdminControllers\Posts\PostTypeController@store')->name('type.posttype.store');
    Route::put('type/{posttype}/{id}', 'AdminControllers\Posts\PostTypeController@update')->name('type.posttype.update');
    Route::get('type/{posttype}/{id}/edit', 'AdminControllers\Posts\PostTypeController@edit')->name('type.posttype.edit');
    Route::delete('type/{posttype}/{id}', 'AdminControllers\Posts\PostTypeController@destroy')->name('type.posttype.destroy');

    // For post
    Route::get('admin/{post}', 'AdminControllers\Posts\PostController@index')->name('admin.post.index');
    Route::get('admin/{post}/create', 'AdminControllers\Posts\PostController@create')->name('admin.post.create');
    Route::post('admin/{post}/store', 'AdminControllers\Posts\PostController@store')->name('admin.post.store');
    Route::put('admin/{post}/{id}', 'AdminControllers\Posts\PostController@update')->name('admin.post.update');
    Route::get('admin/{post}/{id}/edit', 'AdminControllers\Posts\PostController@edit')->name('admin.post.edit');
    Route::get('admin/{post}/{id}', 'AdminControllers\Posts\PostController@childlist')->name('post.childlist');
    Route::delete('admin/{post}/{id}', 'AdminControllers\Posts\PostController@destroy')->name('admin.post.destroy');
    Route::delete('delete_pagethumbnail/{id}', 'AdminControllers\Posts\PostController@delete_pagethumbnail');
    Route::delete('delete_icon/{id}', 'AdminControllers\Posts\PostController@delete_icon');
    Route::delete('delete_thumbnail/{id}', 'AdminControllers\Posts\PostController@delete_thumbnail');
    Route::delete('delete_banner/{id}', 'AdminControllers\Posts\PostController@delete_banner');
    Route::delete('delete_audio/{id}', 'AdminControllers\Posts\PostController@delete_audio');
    Route::put('poststatus/{id}', 'AdminControllers\Posts\PostController@poststatus')->name('admin.poststatus');
    Route::put('globalpost/{id}', 'AdminControllers\Posts\PostController@globalpost')->name('admin.globalpost');

    Route::delete('delete_portfolio_thumb/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_portfolio_pthumb');
    Route::delete('delete_picon/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_picon');
    Route::delete('delete_pthumbnail/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_pthumbnail');
    Route::delete('delete_pbanner/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_pbanner');
    Route::delete('delete_portfolio_cat/{id}', 'AdminControllers\Portfolios\PortfolioCategoryController@delete_category_thumb');


// Associated Post
    Route::get('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@associated_post')->name('associated.post.index');
    Route::get('admin/associated/{type}/{id}/create', 'AdminControllers\Posts\AssociatedPostController@create')->name('admin.associated.create');
    Route::post('admin/associated/{type}/{id}/store', 'AdminControllers\Posts\AssociatedPostController@store')->name('admin.associated.store');
    Route::delete('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@destroy')->name('admin.associated.destroy');
    Route::get('admin/associated/{type}/{id}/edit', 'AdminControllers\Posts\AssociatedPostController@edit')->name('admin.associated.edit');
    Route::put('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@update')->name('admin.associated.update');

// Associated Portfolios
    Route::get('admin/associates/{type}/{id}', 'AdminControllers\Portfolios\AssociatedPortfolioController@associated_post')->name('associates.post.index');
    Route::get('admin/associates/{type}/{id}/create', 'AdminControllers\Portfolios\AssociatedPortfolioController@create')->name('admin.associates.create');
    Route::post('admin/associates/{type}/{id}/store', 'AdminControllers\Portfolios\AssociatedPortfolioController@store')->name('admin.associates.store');
    Route::delete('admin/associates/{type}/{id}', 'AdminControllers\Portfolios\AssociatedPortfolioController@destroy')->name('admin.associates.destroy');
    Route::get('admin/associates/{type}/{id}/edit', 'AdminControllers\Portfolios\AssociatedPortfolioController@edit')->name('admin.associates.edit');
    Route::put('admin/associates/{type}/{id}', 'AdminControllers\Portfolios\AssociatedPortfolioController@update')->name('admin.associates.update');

    // Upload multiple document
    Route::get('doc/multipledocument/{post_id}', 'AdminControllers\Posts\PostDocController@index')->name('doc.multipledocument');
    Route::get('doc/multipledocument/{post_id}/create', 'AdminControllers\Posts\PostDocController@create');
    Route::post('doc/multipledocument/store', 'AdminControllers\Posts\PostDocController@store')->name('multipledocument.store');
    Route::get('doc/multipledocument/{post_id}/{id}/edit', 'AdminControllers\Posts\PostDocController@edit');
    Route::put('doc/multipledocument/{post_id}', 'AdminControllers\Posts\PostDocController@update');
    Route::delete('doc/deleterow/{id}', 'AdminControllers\Posts\PostDocController@destroy');
    Route::delete('doc/multipledocument/{id}', 'AdminControllers\Posts\PostDocController@delete_doc_file');

     
    View::composer(['*'], function ($view) {
        $posttype = App\Models\Posts\PostTypeModel::orderBy('ordering', 'asc')->get();
        $view->with('posttype', $posttype);
    });
});
